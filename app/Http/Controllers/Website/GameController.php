<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\GameResource;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['images', 'platforms', 'accounts', 'modes'])->paginate();

        return GameResource::collection($games);
    }

    public function show(Game $game)
    {
        return response([
            'game' => new GameResource($game),
        ]);
    }
}
