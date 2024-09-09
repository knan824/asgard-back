<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\GameResource;
use App\Models\Game;

class GameController extends Controller
{

    public function index()
    {
        $games = Game::paginate(10);

        return response(
            [
            'message' => 'Games retrieved successfully',
            'games' => GameResource::collection($games),
            ]
                        );
    }


    public function show(Game $game)
    {

        return response(
            [
                'message' => 'Game retrieved successfully',
                'game' => new GameResource($game)
            ]
                        );
    }

}
