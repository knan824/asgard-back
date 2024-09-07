<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Auth\RegisterRequest;
use App\Http\Resources\Website\UserResource;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function store(RegisterRequest $request)
    {
        $credentials = $request->registerUser();

        return response()->json([
            'token' => $credentials['token'],
            'user' => UserResource::make($credentials['user']),
        ]);
    }
}
