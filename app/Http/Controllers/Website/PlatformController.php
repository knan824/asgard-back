<?php

namespace App\Http\Controllers\Website;

use App\Filters\Admin\PlatformFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\PlatformResource;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index(PlatformFilter $filter)
    {
        $platforms = Platform::filter($filter)->paginate();

        return response(PlatformResource::collection($platforms));
    }

    public function show(Platform $platform)
    {
        return response([
            'platform' => new PlatformResource($platform),
        ]);
    }
}

