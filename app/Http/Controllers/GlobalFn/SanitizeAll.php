<?php

namespace App\Http\Controllers\GlobalFn;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class SanitizeAll extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    /**
     * 
     * Sanitizer is used to change special chars to html form of it from requests for safety purposes
     * for example: <b>something</b> will be written as &lt;b&gt;something&lt;/b&gt; text.
     * $request is the *entire* request. Not just a part of it 
     * $expected is array of object of expected array keys. It's not a mandatory attribute
     * $expected = [ 
     * (object)['key'=>'keyname', 'type'=>'str'], //this will return '' if value not exist
     * (object)['key'=>'keyname2', 'type'=>'int'], //this will return 0 if value not exist
     * (object)['key'=>'keyname3', 'type'=>'float'], //this will return 0.0 if value not exist
     * (object)['key'=>'keyname4', 'type'=>'double'], //this will return 0.0 if value not exist
     * (object)['key'=>'keyname5', 'type'=>'object'], //this will return new stdClass() if value not exist
     * (object)['key'=>'keyname6', 'type'=>'null'], //this will return null if value not exist
     * (object)['key'=>'keyname7', 'type'=>'bool'], //this will return false if value not exist
     * ]
     * if the expected array keys aren't found in the list of existing array, it will create empty keys
     * in case the type is not on the list, '' will be returned instead
     * you can also add 'default' => something to overide the default value. Just make sure you use proper data type
     * obviously, except for null
     * 
     * example: 
     * function (Request $request) { 
     * $whatever = Sanitizer::sanitizer($request, $expected);
     * }
     * or
     * function (Request $request) { 
     * $whatever = Sanitizer::sanitizer($request, [(object)['key'=>'keyname', 'type'=>'str']]);}
     * or just
     * function (Request $request) { 
     * $whatever = Sanitizer::sanitizer($request, [(object)['key'=>'keyname', 'type'=>'str']]);}
     * 
     * the result will be something like this:
     * $whatever = ['search' => 'x', 'id' => ''];
     * 
     * note:      
     * 1. this function is non-editable
     * 2. becareful with boolean HTML input often sends string false instead of boolean false, 
     *    causing php to read it as true due to it being a string. try to send null instead of 
     *    true/false
     */

    static function sanitizer($req, array $expected = [])
    {
        $sanitized = array();
        foreach ($req->except('_token', 'page') as $key => $value) {
            if (!is_file($value)) {
                if ($value == 0 && $value != null) {
                    $sanitized[$key] = 0;
                } elseif (!is_null($value)) {
                    if (!is_array($value)) {
                        $sanitized[$key] = empty($value) ? '' : htmlspecialchars($value);
                    } else {
                        foreach ($value as $key2 => $value2) {
                            $sanitized[$key][$key2] = empty($value2) ? '' : htmlspecialchars($value2);
                        }
                    }
                } else {
                    $sanitized[$key] = null;
                }
            }
        }
        foreach ($expected as $key => $value) {
            if (!array_key_exists($value->key, $sanitized)) {
                $defaultisset = isset($value->default);
                $valuetype = $defaultisset ? gettype($value->default) : 'null';

                match ($value->type) {
                    'str' => $emptyVal = $defaultisset && $valuetype == 'string' ? $value->default : '',
                    'string' => $emptyVal = $defaultisset && $valuetype == 'string' ? $value->default : '',
                    'int' => $emptyVal = $defaultisset && $valuetype == 'integer' ? $value->default : 0,
                    'integer' => $emptyVal = $defaultisset && $valuetype == 'integer' ? $value->default : 0,
                    'float' => $emptyVal = $defaultisset && $valuetype == 'double' ? $value->default : 0.0,
                    'double' => $emptyVal = $defaultisset && $valuetype == 'double' ? $value->default : 0.0,
                    'array' => $emptyVal = $defaultisset && $valuetype == 'array' ? $value->default : [],
                    'object' => $emptyVal = $defaultisset && $valuetype == 'object' ? $value->default : new \stdClass(),
                    'null' => $emptyVal = null,
                    'bool' => $emptyVal = $defaultisset && $valuetype == 'boolean' ? $value->default : false,
                    'boolean' => $emptyVal = $defaultisset && $valuetype == 'boolean' ? $value->default : false,
                    default => $emptyVal = $defaultisset && $valuetype == 'string' ? $value->default : '',
                };
                $sanitized[$value->key] = $emptyVal;
            }
        }
        $sanitized['is_sanitized'] = true;
        return $sanitized;
    }
}
