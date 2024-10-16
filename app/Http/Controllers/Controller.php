<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * avoid adding too many functions
     * use globally usable function as function(){return} instead of making function for each feature
     * read HMVC for more detail 
     * 
     * avoid compacting too many variables. 
     * put variabels into coredata/pagedata depending of their use
     * currently, 27 August 2024, 
     * I'm considering between using array ['var_name'=> $value] 
     * or using object {'var_name' => $value}
     * the only difference is the way you call it in blade
     * $coredata->var_name and $coredata['var_name']
     * and apparently how to compare it.
     * either in_array($needle, $coredata) 
     * or isset($coredata->something)
     * or combine both so you could do 
     * if(in_array($needle, $coredata->something))
     */

    public function example(Request $req, String $page = '', ?String $subpage = '') # $page is expected to exist
    {
        /* default values */
        $coredata = ['']; # data for comparison and conditions
        $pagedata = ['']; # data to show to user
        $blade = ''; # which blade file will be loaded?
        $coredata['dependency'] = []; #dependencies for the blade, check layouts/core.blade.php for more info

        #change the color and/or message as you need, change use to true to bring it. check public/js/toast.js for more info
        $toast = (object)['use'=>false, 'color'=>'primary', 'message'=>''];
        $toastType = ['singularToast','multiToast','multiGroupedToast'];
        /* default values end */

        if (empty($page)) {
            # page not found
            $page = '400';
        }

        # I'll put try{}catch(){} below the case in this example, 
        # but put it in its smaller component instead of there
        # example: lets say we do
        # case('caseName'):
        # Class::getCaseName();
        # break;
        # put the try catch in the getCaseName().

        switch ($page) {
            case 'login':
                try {
                } catch (\Throwable $th) {
                    # an error occurred during x
                }
                break;
            case '400':
                # fall through as default
            default: 
                #page not listed
                try {
                    # if something went wrong, write down the log
                } catch (\Throwable $th) {
                    # an error occurred during x
                }
                break;
        }
        try {
            //code...
            $compact = compact('coredata', 'pagedata');
            if($toast->use){
                return view($blade, $compact)->with('toast', $toast);
            } else {
                return view($blade, $compact);
            }
        } catch (\Throwable $th) { # an error occurred during page render
            # write down the log
            //throw $th;
        }
    }

    public function page(Request $req, ?String $page = 'index', ?String $subpage = '') # $page is expected to exist
    {
        // if($req->dev == 1){
        //     Admin::insert([
        //         'username'  => 'Testadmin1',
        //         'password'  => Hash::make('Testadmin1'),
        //         'tgl_active'=> Carbon::now()->format('Y-m-d'),
        //         'active_status'=> 1
        //     ]);
        // }
        /* default values */
        $coredata = []; # data for comparison and conditions
        $pagedata = []; # data to show to user
        $blade = ''; # which blade file will be loaded?
        $coredata['dependency'] = []; #dependencies for the blade, check layouts/core.blade.php for more info

        #change the color and/or message as you need, change use to true to bring it. check public/js/toast.js for more info
        $toast = (object)['use'=>false, 'color'=>'primary', 'message'=>''];
        $toastType = ['singularToast','multiToast','multiGroupedToast'];

        /* default values end */
        
        if (empty($page)) {
            # page not found
            $page = '400';
        }

        switch ($page) {
            case 'index':
                # fall through as default
            case 'landing':
                # fall through as default
            default: 
                #no page listed
                // array_push($coredata['dependency'], 'OwlCarousel');
                $blade = 'guest.index';
            break;
        }

        try {
            //code...
            $compact = compact('coredata', 'pagedata');
            if($toast->use){
                return view($blade, $compact)->with('toast', $toast);
            } else {
                return view($blade, $compact);
            }
        } catch (\Throwable $th) { # an error occurred during page render
            # write down the log
            //throw $th;
        }
    }
}
