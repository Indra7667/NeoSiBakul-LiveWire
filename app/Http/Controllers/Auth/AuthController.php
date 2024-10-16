<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\GlobalFn\RateLimiterFn;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\GlobalFn\SanitizeAll;
use App\Models\Admin;

class AuthController extends BaseController
{

    public function login($as = 'ukm')
    {
        $coredata = ['']; # data for comparison and conditions
        $pagedata = ['']; # data to show to user
        $blade = ''; # which blade file will be loaded?
        $coredata['dependency'] = []; #dependencies for the blade, check layouts/core.blade.php for more info

        #change the color and/or message as you need, change use to true to bring it. check public/js/toast.js for more info
        $toast = (object) ['use' => false, 'color' => 'primary', 'message' => ''];
        /* default values end */

        if (empty($as)) {
            # page not found
            $as = '400';
        }

        switch ($as) {
            case 'admin':
                $blade = 'auth.login-admin';
                break;
            case 'ukm':
            # fall through as default
            default:
                $blade = 'auth.login-user';
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
            if ($toast->use) {
                return view($blade, $compact)->with($toast->color, $toast->message);
            } else {
                // dd('test');
                return view($blade, $compact);
            }
        } catch (\Throwable $th) { # an error occurred during page render
            # write down the log
            //throw $th;
        }

    }

    public function login_post(Request $req, $as = 'ukm')
    {
        try {
            $check = RateLimiterFn::checkTooManyFailedAttempts();
            // dd($check);
            if (!$check->pass) {
                return back()->with('danger', "spam detected, wait $check->time s");
            }
            $expected = [
                (object)['key'=>'username','type'=>'str'],
                (object)['key'=>'id_sibakul','type'=>'str'],
                (object)['key'=>'password','type'=>'str'],
                (object)['key'=>'remember','type'=>'bool'],
            ];
            $req = (object) SanitizeAll::sanitizer($req, $expected);
            //code...
            switch ($as) {
                case 'admin':
                    if (!Auth::guard('admin')->attempt(['username' => $req->username, 'password' => $req->password], false)) {
                        RateLimiterFn::hit(10);
                        return back()->with('danger', "username/password not found");
                    } else {
                        // $user = Admin::where('username', $req->username)->first();
                        // auth::guard('admin')->setUser($user);
                        // dd(get_defined_vars(), auth::guard('admin'), 'login succeed');
                        Session::regenerate();
                        Session::save();
                        auth::guard('admin')->login(Auth::guard('admin')->user(), false);
                        // $req->session()->regenerate();
                        // return redirect()->route('admin.index');
                        return redirect()->intended(RouteServiceProvider::ADM_HOME);
                    }
                case 'ukm':
                # fall through
                default:
                    if (!Auth::guard('web')->attempt(['id_sibakul' => $req->idsibakul, 'password' => $req->password], $req->remember)) {
                        RateLimiterFn::hit(10);
                        return back()->with('danger', "username/password not found");
                    } else {
                        Session::regenerate();
                        return redirect()->route('ukm.index');
                    }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(Request $req, $as)
    {
        $toast = json_encode(['use'=>true, 'title'=>'logged out', 'label'=>'logged out', 'icon'=>'warning']);

        switch ($as) {
            case 'admin':
                Auth::guard('admin')->logout();
                break;
            case 'ukm':
            #fall through
            default:
                Auth::logout();
                break;
        }

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect()->route('index')->with('singularToast', $toast);
    }
}
