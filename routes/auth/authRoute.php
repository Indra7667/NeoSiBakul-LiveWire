<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller; #main Controller
use App\Http\Controllers\Auth\AuthController; #auth Controller
use App\Http\Controllers\AjaxController; #main AjaxController
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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

/* 
* -------------------------------------------------------------------------
* route get 
* -------------------------------------------------------------------------
*/

// Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    // Route::get('login', [AuthController::class, 'login'])->name('login');
    
    // Volt::route('login', 'pages.auth.login')
    //     ->name('login');
    // Volt::route('login-admin', 'pages.auth.login-admin')
    //     ->name('login-admin');
    Route::get('login/{as?}', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login/{as?}/post',[AuthController::class, 'login_post'])->name('auth.login_post');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::get('logout/{as?}', [AuthController::class, 'logout'])->name('auth.logout');

// Route::get('page/{page?}/{subpage?}', [Controller::class, 'page'])->name('accessPage');

/* route get end */

/* 
* --------------------------------------------------------------------------
* Ajax
* -------------------------------------------------------------------------- 
* context is required, but grup is not required, 
* use controller to check whether or not the value exist
*/

// Route::get('ajax/{context?}/{group?}', [AjaxController::class, 'main'])->name('useAjax'); 

/* ajax end */

// require __DIR__.'/auth.php';
