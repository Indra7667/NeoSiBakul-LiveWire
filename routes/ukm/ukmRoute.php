<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller; #main Controller
use App\Http\Controllers\Auth\AuthController; #main Controller
use App\Http\Controllers\AjaxController; #main AjaxController
use Livewire\Volt\Volt;

Route::middleware('auth:web')->group(function () {
    Route::get('/', function(){return view('ukm.dashboard');})->name('ukm.index');
    Route::get('index', function(){return view('ukm.dashboard');})->name('ukm.index');
    Route::get('dashboard', function(){return view('ukm.dashboard');})->name('ukm.index');
});
