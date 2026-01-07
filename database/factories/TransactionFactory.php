<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * TransactionFactory
 *
 * Generates fake marketplace transactions between users.
 *
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Transaction>
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buyer_id' => User::factory(),
            'seller_id' => User::factory(),
            'total_price' => $this->faker->randomFloat(2, 5, 500),
            'status' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}

