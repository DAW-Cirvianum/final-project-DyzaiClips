<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ProductValue>
 */
class ProductValueFactory extends Factory
{
    public function definition(): array
    {
        $basePrice = fake()->randomFloat(2, 2, 200);

        return [
            'condition' => fake()->randomElement(['new', 'used']),
            'price' => fake()->boolean
                ? $basePrice + fake()->randomFloat(2, 5, 50)   // new
                : max(1, $basePrice - fake()->randomFloat(2, 1, 20)), // used
            'stock' => fake()->numberBetween(1, 20),
        ];
    }
}


