<?php

use Illuminate\Support\Facades\Route;

Route::resource('configurables', ConfigurablesController::class);
Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('users/oftype/{role}', [\Aboleon\Framework\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::resource('users', UserController::class)->middleware('can:isAdmin')->except('index');