<?php

namespace Database\Factories;

use App\Models\Box;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * BoxFactory
 *
 * Generates fake Pokémon boxes for testing purposes.
 *
 * @extends Factory<Box>
 */
class BoxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Box>
     */
    protected $model = Box::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Pokémon Box ' . $this->faker->word(),
            'productions' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}

