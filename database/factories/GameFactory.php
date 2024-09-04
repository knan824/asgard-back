<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'developer' => fake()->company(),
            'release_year' => fake()->year(),
            'mode' => fake()->word(),
            'is_available' => fake()->boolean(),
            'is_visible' => fake()->boolean(),
        ];
    }
}
