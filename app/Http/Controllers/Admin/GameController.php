<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\GameFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameStoreRequest;
use App\Http\Requests\Admin\GameUpdateRequest;
use App\Http\Resources\Admin\GameResource;
use App\Models\Game;

class GameController extends Controller
{
    public function index(GameFilter $filter)
    {
        $games = Game::with(['accounts', 'modes', 'platforms', 'images'])->filter($filter)->paginate();

        return GameResource::collection($games);
    }

    public function store(GameStoreRequest $request)
    {
        $game = $request->storeGame();

        return response([
            'message' =>  __('games.store'),
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
            'message' =>  __('games.update'),
            'game' => new GameResource($game),
        ]);
    }

    public function destroy(Game $game)
    {
        $game->remove();

        return response([
            'message' =>  __('games.destroy'),
        ]);
    }
}
