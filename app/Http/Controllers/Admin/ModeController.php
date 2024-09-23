<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ModeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ModeStoreRequest;
use App\Http\Requests\Admin\ModeUpdateRequest;
use App\Http\Resources\Admin\ModeResource;
use App\Models\Mode;

class ModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ModeFilter $filter)
    {
        $modes = Mode::filter($filter)->paginate();

        return response(ModeResource::collection($modes));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeStoreRequest $request)
    {
        $mode = $request->storeMode();

        return response([
            'mode' => new ModeResource($mode),
            'message' => 'Mode created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mode $mode)
    {
        return response([
            'mode' => new ModeResource($mode),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModeUpdateRequest $request, Mode $mode)
    {
        $mode = $request->updateMode();

        return response([
            'mode' => new ModeResource($mode),
            'message' => 'Mode updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mode $mode)
    {
        if (!$mode->remove()) {
            return response([
                'message' => 'Mode cannot be deleted',
            ], 400);
        }

        return response([
            'message' => 'Mode deleted successfully',
        ]);
    }
}
