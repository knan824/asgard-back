<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\ModeController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\WishlistController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('accounts', AccountController::class);
    Route::apiResource('games', GameController::class);
    Route::apiResource('modes', ModeController::class);
    Route::apiResource('platforms', PlatformController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::apiResource('wishlists', WishlistController::class);
});
