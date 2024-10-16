<?php

namespace App\Http\Controllers\GlobalFn;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class SanitizeFilter extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    /* an attempt to automate the filter sanitizer. 
     * The $req is Request $request->query or just the $request (patched in 14 May 2024)
     * just know that $req->query is way faster
     * $expected is array of object of expected array keys. It's not a mandatory attribute
     * $expected = [ 
       (object)['key'=>'keyname', 'type'=>'str'], //this will return '' if value not exist
       (object)['key'=>'keyname2', 'type'=>'int'], //this will return 0 if value not exist
       (object)['key'=>'keyname3', 'type'=>'float'], //this will return 0.0 if value not exist 
       (object)['key'=>'keyname4', 'type'=>'double'], //this will return 0.0 if value not exist
       (object)['key'=>'keyname5', 'type'=>'object'], //this will return new stdClass() if value not exist
       (object)['key'=>'keyname6', 'type'=>'null'], //this will return null if value not exist
       (object)['key'=>'keyname7', 'type'=>'bool'], //this will return false if value not exist
       ]
     * if the expected array keys aren't found in the list of existing array, it will create empty keys
     * in case the type is not on the list, '' will be returned instead
     * you can also add 'default' => something to overide the default value. Just make sure you use proper data type
     * obviously, except for null
     */


    static function filterAutoHandle($req, array $expected = [])
    {
        $filters = array();
        // try {
        //     //code...
        //     $req = gettype($req) == "string"? $req : $req->query;
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     throw $req;
        // }
        try {
            //code...
            foreach ($req as $key => $value) {
                if (!is_array($value)) {
                    $filters[$key] = empty($value) ? '' : htmlspecialchars(strip_tags($value));
                } else {
                    foreach ($value as $key2 => $value2) {
                        $filters[$key][$key2] = empty($value2) ? '' : htmlspecialchars(strip_tags($value2));
                    }
                }
            }
        } catch (\Throwable $th) {
            $req = $req->query;
            foreach ($req as $key => $value) {
                if (!is_array($value)) {
                    $filters[$key] = empty($value) ? '' : htmlspecialchars(strip_tags($value));
                } else {
                    foreach ($value as $key2 => $value2) {
                        $filters[$key][$key2] = empty($value2) ? '' : htmlspecialchars(strip_tags($value2));
                    }
                }
            }
        }
        foreach ($expected as $key => $value) {
            if (!array_key_exists($value->key, $filters)) {
                $valueisset = isset($value->default);
                $valuetype = $valueisset ? gettype($value->default) : 'null';
                match ($value->type) {
                    'str' => $emptyVal = $valueisset && $valuetype == 'string' ? $value->default : '',
                    'int' => $emptyVal = $valueisset && $valuetype == 'integer' ? $value->default : 0,
                    'float' => $emptyVal = $valueisset && $valuetype == 'double' ? $value->default : 0.0,
                    'double' => $emptyVal = $valueisset && $valuetype == 'double' ? $value->default : 0.0,
                    'array' => $emptyVal = $valueisset && $valuetype == 'array' ? $value->default : [],
                    'object' => $emptyVal = $valueisset && $valuetype == 'object' ? $value->default : new \stdClass(),
                    'null' => $emptyVal = null,
                    'bool' => $emptyVal = $valueisset && $valuetype == 'boolean' ? $value->default : false,
                    default => $emptyVal = $valueisset && $valuetype == 'string' ? $value->default : '',
                };
                $filters[$value->key] = $emptyVal;
            }
        }
        return $filters;
    }

}
