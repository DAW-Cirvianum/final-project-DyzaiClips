<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Pack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * CardFactory
 *
 * Generates fake Pokémon cards belonging to a pack.
 *
 * @extends Factory<Card>
 */
class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Card>
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Pokémon Card ' . $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 0.5, 200),
            'collection' => $this->faker->word(),
            'status' => $this->faker->randomElement(['common', 'rare', 'legendary']),
            'productions' => $this->faker->numberBetween(1000, 50000),
            'pack_id' => Pack::factory(),
        ];
    }
}

