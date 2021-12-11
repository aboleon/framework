<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth:sanctum', 'verified'])->prefix(config('aboleon_framework.route'))->name(config('aboleon_framework.route').'.')->group(callback: function () {

});

Route::get('/', function () {
    return view('front.home');
})->name('front');
