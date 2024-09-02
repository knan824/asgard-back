<?php

use App\Http\Controllers\Admin\GameController;
use Illuminate\Support\Facades\Route;

Route::apiResource('games', GameController::class);
