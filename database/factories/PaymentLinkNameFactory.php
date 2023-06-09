<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class PaymentLinkNameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->name(),
            'active'=>fake()->boolean(),
            'default_price' => fake()->randomFloat(8,10, 10000),
            'description' => fake()->paragraph(),
            'metadata' => fake()->randomLetter()
        ];
    }
}
