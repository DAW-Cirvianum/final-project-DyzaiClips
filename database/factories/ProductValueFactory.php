<?php

namespace Database\Factories;

use App\Models\ProductValue;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * ProductValueFactory
 *
 * Generates fake price and condition variations for products.
 *
 * @extends Factory<ProductValue>
 */
class ProductValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<ProductValue>
     */
    protected $model = ProductValue::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'price' => $this->faker->randomFloat(2, 1, 500),
            'stock' => $this->faker->numberBetween(1, 50),
        ];
    }
}

