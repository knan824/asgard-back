<?php

use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Website\Auth\LogoutController;
use App\Http\Controllers\Website\Auth\RegisterController;
use App\Http\Controllers\Website\Auth\UsernameController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::post('check-username', [UsernameController::class, 'store'])->name('check-username');
Route::post('login', [LoginController::class, 'store'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [LogoutController::class, 'store'])->name('logout');
});
