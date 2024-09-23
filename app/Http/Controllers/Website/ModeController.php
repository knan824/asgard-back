<?php

namespace App\Http\Controllers\Website;

use App\Filters\Website\ModeFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\ModeResource;
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
     * Display the specified resource.
     */
    public function show(Mode $mode)
    {
        return response([
            'mode' => new ModeResource($mode),
        ]);
    }
}
