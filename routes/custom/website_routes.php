<?php

use App\Http\Controllers\Website\GameController;
use App\Http\Controllers\Website\PlatformController;
use App\Http\Controllers\Website\SubscriptionController;
use App\Http\Controllers\Website\WishlistController;
use Illuminate\Support\Facades\Route;

Route::apiResource('games', GameController::class)->only(['index', 'show']);
Route::apiResource('platforms', PlatformController::class)->only(['index', 'show']);
Route::apiResource('subscriptions', SubscriptionController::class)->only(['index', 'show']);
Route::apiResource('users.wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);
