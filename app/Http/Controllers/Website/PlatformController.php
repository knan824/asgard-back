<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\platform;
use Illuminate\Http\Request;
use App\Http\Resources\Website\PlatformResource;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::paginate(10);
        return PlatformResource::collection($platforms);
    }

    public function show(Platform $platform)
    {
        return response([
            'platform' => new PlatformResource($platform),
        ]);
    }
}

