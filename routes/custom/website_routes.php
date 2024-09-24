<?php

use App\Http\Controllers\Website\AccountController;
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
Route::apiResource('accounts', AccountController::class);
Route::apiResource('wishlists', WishlistController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('wishlists', WishlistController::class)->only(['store', 'update', 'destroy']);
});
