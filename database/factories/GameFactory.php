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
            'slug' => fake()->slug(),
            'developer' => fake()->company(),
            'release_year' => fake()->date(),
            'is_available' => fake()->boolean(),
            'is_visible' => fake()->boolean(),
        ];
    }
}
