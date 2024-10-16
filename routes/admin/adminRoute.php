<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController; #main Controller
use App\Http\Controllers\Auth\AuthController; #main Controller
use App\Http\Controllers\AjaxController; #main AjaxController
use Livewire\Volt\Volt;

// Route::group(['middleware' => ['auth:admin'] ], function(){
//     // Route::get('/home', 'HomeController@index');
    
//     Route::get('/', function(){return view('admin.adminpage');})->name('admin.index');
//     Route::get('index', function(){return view('admin.adminpage');})->name('admin.index');
//     Route::get('dashboard', function(){return view('admin.adminpage');})->name('admin.index');
// });

Route::middleware('admin')->group(function () {
    Route::get('/{page?}/{subpage?}', [AdminController::class, 'page'])->name('admin.index');
    // Route::get('index', [AdminController::class, 'page'])->name('admin.index');
    // Route::get('dashboard', [AdminController::class, 'page'])->name('admin.index');
});
