<?php

use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Website\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::post('login', [LoginController::class, 'store'])->name('login');
