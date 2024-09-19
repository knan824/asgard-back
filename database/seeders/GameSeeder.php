<?php

namespace Database\Seeders;

use App\Models\Game;
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
        });
    }
}
