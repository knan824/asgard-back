<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformStoreRequest;
use App\Http\Requests\Admin\PlatformUpdateRequest;
use App\Http\Resources\Admin\PlatformResource;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::paginate(10);

        return PlatformResource::collection($platforms);
    }

    public function store(PlatformStoreRequest $request)
    {
        $platforms = $request->storePlatform();

        return response([
            'message' => 'Platform created successfully',
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
            'message' => 'Platform updated successfully',
            'platform' => new PlatformResource($platform),
        ]);
    }

    public function destroy(Platform $platform)
    {
        $platform->remove();

        return response([
            'message' => 'Platform deleted successfully',
        ]);
    }
}
