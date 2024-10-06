<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\PlatformFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformStoreRequest;
use App\Http\Requests\Admin\PlatformUpdateRequest;
use App\Http\Resources\Admin\PlatformResource;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index(PlatformFilter $filter)
    {
        $platforms = Platform::with(['image'])->filter($filter)->paginate();

        return PlatformResource::collection($platforms);
    }

    public function store(PlatformStoreRequest $request)
    {
        $platforms = $request->storePlatform();

        return response([
            'message' => __('platforms.store'),
            'platform' => new PlatformResource($platforms),
        ]);
    }

    public function show(Platform $platform)
    {
        return response([
            'platform' => new PlatformResource($platform),
        ]);
    }

    public function update(PlatformUpdateRequest $request, platform $platform)
    {
        $platform = $request->updatePlatform();

        return response([
            'message' => __('platforms.update'),
            'platform' => new PlatformResource($platform),
        ]);
    }

    public function destroy(Platform $platform)
    {
        $platform->remove();

        return response([
            'message' => __('platforms.destroy'),
        ]);
    }
}
