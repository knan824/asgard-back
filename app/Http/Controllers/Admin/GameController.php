<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameStoreRequest;
use App\Http\Requests\Admin\GameUpdateRequest;
use App\Http\Resources\Admin\GameResource;
use App\Models\Game;

class GameController extends Controller
{

    public function index()
    {
        $games = Game::paginate();

        return response(GameResource::collection($games));
    }

    public function store(GameStoreRequest $request)
    {
        $game = $request->storeGame();
        $game->platforms()->attach($request->platform); //attaches the game to it's platform in platform table

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

    public function update(GameUpdateRequest $request, Game $game)
    {
        $game = $request->updateGame();

        return response([
            'message' => 'Game updated successfully',
            'game' => new GameResource($game),
                        ]);
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return response([
            'message' => 'Game deleted successfully',
                        ]);
    }
}
