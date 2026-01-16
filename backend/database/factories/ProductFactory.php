<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ProductFactory
 *
 * Generates fake marketplace products such as cards, packs or boxes.
 *
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Product>
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'type' => $this->faker->randomElement(['card', 'pack', 'box']),
        ];
    }
}

