<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller; #main Controller
use App\Http\Controllers\AjaxController; #main AjaxController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
|
| don't make any variable mandatory in here ({var}),
| instead, make every variable as optional ({var?}),
| then check the mandatory var in controller
| this will make error logging easier in the future,
| because the validation happen in controller
| 
| avoid adding too many controllers, 
| make sure you use hierarchial controller.
| hierarchial controllers make debug and logging easier
*/

/* route from templates */
// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');
// Route::view('/', 'welcome');
/* route from template end */

/* 
 * -------------------------------------------------------------------------
 * route get 
 * -------------------------------------------------------------------------
 */

Route::get('/', [Controller::class, 'page'])->name('index');

Route::get('page/{page?}/{subpage?}', [Controller::class, 'page'])->name('accessPage');

/* route get end */
/* 
 * --------------------------------------------------------------------------
 * Ajax
 * -------------------------------------------------------------------------- 
 * context is required, but grup is not required, 
 * use controller to check whether or not the value exist
 */

Route::get('ajax/{context?}/{group?}', [AjaxController::class, 'main'])->name('useAjax');

/* ajax end */

/* prefixes */
Route::prefix('/auth')->group(__DIR__ . '/auth/authRoute.php');

Route::prefix('admin')->group(__DIR__ . '/admin/adminRoute.php');

Route::prefix('ukm')->group(__DIR__ . '/ukm/ukmRoute.php');
/* prefixes end */

/* redirects */
Route::get('login', function(){return redirect()->route('auth.login');});

$as = auth()->guard('admin')?'admin':'ukm';
Route::get('logout', function() use ($as){return redirect()->route('auth.logout', ['as'=>$as]);})->name('generic.logout');
/* redirects end */

// require __DIR__.'/auth.php';
