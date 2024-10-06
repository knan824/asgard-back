<?php

namespace App\Http\Controllers\Website;

use App\Filters\Website\PlatformFilter;
use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Http\Resources\Website\PlatformResource;

class PlatformController extends Controller
{
    public function index(PlatformFilter $filter)
    {
        $platforms = Platform::with(['image'])->filter($filter)->paginate();

        return PlatformResource::collection($platforms);
    }

    public function show(Platform $platform)
    {
        return response([
            'platform' => new PlatformResource($platform),
        ]);
    }
}

