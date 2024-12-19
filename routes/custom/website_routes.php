<?php

use App\Http\Controllers\Website\AccountController;
use App\Http\Controllers\Website\AccountUserController;
use App\Http\Controllers\Website\GameController;
use App\Http\Controllers\Website\ModeController;
use App\Http\Controllers\Website\PlatformController;
use App\Http\Controllers\Website\SubscriptionController;
use App\Http\Controllers\Website\WishlistController;
use Illuminate\Support\Facades\Route;

Route::apiResource('games', GameController::class)->only(['index', 'show']);
Route::apiResource('platforms', PlatformController::class)->only(['index', 'show']);
Route::apiResource('subscriptions', SubscriptionController::class)->only(['index', 'show']);
Route::apiResource('modes', ModeController::class);
Route::apiResource('accounts', AccountController::class)->only(['index', 'show']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users.accounts', AccountUserController::class);
    Route::apiResource('wishlists', WishlistController::class);
});
