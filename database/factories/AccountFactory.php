<?php

namespace Database\Factories;

use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        return DB::transaction(function () {
            return [
                'user_id' => User::factory(),
                'psn_email' => fake()->safeEmail,
                'password' => encrypt(Str::random(255)),
                'is_sold' => fake()->boolean,
                'is_blocked' => fake()->boolean,
                'is_primary' => fake()->boolean,
            ];
        });
    }
}
