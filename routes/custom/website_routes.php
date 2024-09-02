<?php

use App\Http\Controllers\Website\GameController;
use Illuminate\Support\Facades\Route;

Route::apiResource('games', GameController::class)->only(['index', 'show']);
