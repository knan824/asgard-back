<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Mode;
use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{

    public function run(): void
    {
        $games = Game::factory()->count(20)->create();

        $games->each(function ($game) {
            $game->platforms()->attach(Platform::inRandomOrder()->first());
            $game->modes()->attach(Mode::inRandomOrder()->first());
        });
    }
}
