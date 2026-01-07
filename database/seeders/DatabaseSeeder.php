<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductValue;
use App\Models\Box;
use App\Models\Pack;
use App\Models\Card;
use App\Models\Transaction;

/**
 * DatabaseSeeder
 *
 * Seeds the application's database with fake data
 * for development and testing purposes.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Create users
        $users = User::factory()->count(10)->create();

        // Create boxes with packs and cards
        Box::factory()
            ->count(5)
            ->has(
                Pack::factory()
                    ->count(10)
                    ->has(
                        Card::factory()->count(15)
                    )
            )
            ->create();

        // Create products
        $products = Product::factory()->count(20)->create();

        // Create product values for each product
        $products->each(function ($product) {
            ProductValue::factory()
                ->count(2)
                ->create([
                    'product_id' => $product->id,
                ]);
        });

        // Create transactions
        Transaction::factory()->count(15)->create();
    }
}
