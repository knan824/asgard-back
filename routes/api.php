<?php

use Illuminate\Support\Facades\Route;

# website api routes
Route::group([
    'as' => 'website.',
], function () {
    if (env('APP_ENV') === 'testing') {
        require base_path('routes/custom/website_auth_routes.php');
        require base_path('routes/custom/website_routes.php');
    } else {
        require_once base_path('routes/custom/website_auth_routes.php');
        require_once base_path('routes/custom/website_routes.php');
    }
});

# admin panel api routes
Route::group([
    'prefix' => 'admin-panel',
    'as' => 'admin.',
], function () {
    if (env('APP_ENV') === 'testing') {
        require base_path('routes/custom/admin_auth_routes.php');
        require base_path('routes/custom/admin_routes.php');
    } else {
        require_once base_path('routes/custom/admin_auth_routes.php');
        require_once base_path('routes/custom/admin_routes.php');
    }
});
