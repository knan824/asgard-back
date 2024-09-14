<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(1, 1000),
            'priceable_id' => function () {
                // Randomly pick a model and return its ID
                $model = fake()->randomElement([Subscription::class]);
                return $model::factory()->create()->id;
            },
            'priceable_type' => function () {
                // Return the class name of the randomly picked model
                return fake()->randomElement([Subscription::class]);
            },
        ];
    }
}
