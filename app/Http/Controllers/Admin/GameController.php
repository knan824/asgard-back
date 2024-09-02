<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameStoreRequest;
use App\Http\Requests\Admin\GameUpdateRequest;
use App\Http\Resources\Admin\GameResource;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::paginate();

        return response(GameResource::collection($games));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameStoreRequest $request)
    {
        $game = $request->storeGame();

        return response([
            'message' => 'Game created successfully',
            'game' => new GameResource($game),
        ]);
    }

    public function show(Game $game)
    {
        return response([
            'game' => new GameResource($game),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameUpdateRequest $request, Game $game)
    {
        $game = $request->updateGame();

        return response([
            'message' => 'Game updated successfully',
            'game' => new GameResource($game),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return response([
            'message' => 'Game deleted successfully',
        ]);
    }
}
