<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Auth\UsernameRequest;

class UsernameController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(UsernameRequest $request)
    {
        $availability = $request->checkUsernameAvailable();

        return response([
            'availability' => $availability
        ]);
    }
}
