<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'developer' => fake()->company(),
            'release_year' => fake()->year(),
            'mode' => fake()->word(),
            'platform' => fake()->word(),
            'price' => fake()->biasedNumberBetween(),
            'is_available' => fake()->boolean(),
            'is_visible' => fake()->boolean(),

        ];
    }
}