<?php

namespace Database\Factories;

use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'psn_email' => fake()->safeEmail(),
            'user_id' => User::factory(),
//            'platform_type' => Platform::factory(),
            'password' => fake()->password(),
            'is_sold' => fake()->boolean(),
            'is_blocked' => fake()->boolean(),
            'is_primary' => fake()->boolean(),
        ];
    }
}
