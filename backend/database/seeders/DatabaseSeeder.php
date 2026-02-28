<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
 * Seeds the application's database with coherent and realistic data
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

        User::firstOrCreate(
            ['email' => 'admin@pokemonmarket.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now()
            ]
        );

        User::factory()->count(10)->create();


        Box::factory()
            ->count(2)
            ->has(
                Pack::factory()
                    ->count(2)
                    ->has(
                        Card::factory()->count(2)
                    )
            )
            ->create();

        $this->call(ProductSeeder::class);

        
        Product::all()->each(function ($product) {

            // Base price depending on product type
            $basePrice = match ($product->type) {
                'box'  => rand(90, 160),
                'pack' => rand(4, 8),
                'card' => rand(5, 200),
                default => rand(10, 50),
            };

            // NEW product value
            ProductValue::create([
                'product_id' => $product->id,
                'condition'  => 'new',
                'price'      => $basePrice,
                'stock'      => rand(5, 20),
            ]);

            // USED product value (always cheaper)
            ProductValue::create([
                'product_id' => $product->id,
                'condition'  => 'used',
                'price'      => max(1, $basePrice - rand(5, 30)),
                'stock'      => rand(1, 10),
            ]);
        });

        /**
         * Create transactions (random users, demo purposes)
         */
        Transaction::factory()->count(15)->create();
    }
}
