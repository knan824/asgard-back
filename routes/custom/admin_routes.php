<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\PlatformController;
use Illuminate\Support\Facades\Route;

Route::apiResource('games', GameController::class);
Route::apiResource('platforms', PlatformController::class);
