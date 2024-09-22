<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Mode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameMode>
 */
class GameModeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id' => Game::factory(),
            'mode_id' => Mode::factory(),
        ];
    }
}
