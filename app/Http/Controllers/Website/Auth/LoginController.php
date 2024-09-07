<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Auth\LoginRequest;
use App\Http\Resources\Website\UserResource;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        $credentials = $request->loginUser();

        return response()->json([
            'token' => $credentials['token'],
            'user' => UserResource::make($credentials['user']),
        ]);
    }
}
