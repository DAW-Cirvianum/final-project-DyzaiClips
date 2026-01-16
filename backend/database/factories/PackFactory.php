<?php

namespace Database\Factories;

use App\Models\Pack;
use App\Models\Box;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * PackFactory
 *
 * Generates fake Pokémon packs belonging to a box.
 *
 * @extends Factory<Pack>
 */
class PackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Pack>
     */
    protected $model = Pack::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Pokémon Pack ' . $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 3, 10),
            'productions' => $this->faker->numberBetween(5000, 200000),
            'box_id' => Box::factory(),
        ];
    }
}

