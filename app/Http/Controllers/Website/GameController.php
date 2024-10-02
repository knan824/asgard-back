<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\GameResource;
use App\Models\Game;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['images', 'platforms', 'accounts', 'modes'])->paginate();

        return GameResource::collection($games);
    }

    public function show(Game $game)
    {
        if (! $game->is_visible) throw new NotFoundHttpException;

        return response([
            'game' => new GameResource($game),
        ]);
    }
}
