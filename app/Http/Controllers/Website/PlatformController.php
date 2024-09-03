<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{

    public function index()
    {
        $platforms = Platform::paginate();

        return response($platforms);
    }

    public function show(Platform $platform)
    {
        return response($platform);
    }

}

