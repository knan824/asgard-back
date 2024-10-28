<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function store()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logged out successfully',
        ]);
    }
}
