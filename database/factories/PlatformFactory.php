<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlatformFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            ];
    }
}
