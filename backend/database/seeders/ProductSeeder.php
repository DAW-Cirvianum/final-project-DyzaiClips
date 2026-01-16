<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

/**
 * ProductSeeder
 *
 * Seeds products with real Pokémon cards, packs and boxes.
 */
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // BOXES 
            ['name' => 'Scarlet & Violet Booster Box', 'type' => 'box'],
            ['name' => 'Paldea Evolved Booster Box', 'type' => 'box'],
            ['name' => 'Obsidian Flames Booster Box', 'type' => 'box'],
            ['name' => 'Paradox Rift Booster Box', 'type' => 'box'],
            ['name' => 'Temporal Forces Booster Box', 'type' => 'box'],
            ['name' => 'Evolving Skies Booster Box', 'type' => 'box'],
            ['name' => 'Brilliant Stars Booster Box', 'type' => 'box'],
            ['name' => 'Lost Origin Booster Box', 'type' => 'box'],
            ['name' => 'Fusion Strike Booster Box', 'type' => 'box'],
            ['name' => 'Crown Zenith Booster Box', 'type' => 'box'],

            //PACKS 
            ['name' => 'Scarlet & Violet Booster Pack', 'type' => 'pack'],
            ['name' => 'Paldea Evolved Booster Pack', 'type' => 'pack'],
            ['name' => 'Obsidian Flames Booster Pack', 'type' => 'pack'],
            ['name' => 'Paradox Rift Booster Pack', 'type' => 'pack'],
            ['name' => 'Temporal Forces Booster Pack', 'type' => 'pack'],
            ['name' => 'Evolving Skies Booster Pack', 'type' => 'pack'],
            ['name' => 'Brilliant Stars Booster Pack', 'type' => 'pack'],
            ['name' => 'Lost Origin Booster Pack', 'type' => 'pack'],
            ['name' => 'Fusion Strike Booster Pack', 'type' => 'pack'],
            ['name' => 'Crown Zenith Booster Pack', 'type' => 'pack'],

            //CARDS 
            ['name' => 'Charizard VMAX', 'type' => 'card'],
            ['name' => 'Pikachu V', 'type' => 'card'],
            ['name' => 'Mewtwo GX', 'type' => 'card'],
            ['name' => 'Rayquaza VMAX', 'type' => 'card'],
            ['name' => 'Gengar VMAX', 'type' => 'card'],
            ['name' => 'Lugia VSTAR', 'type' => 'card'],
            ['name' => 'Umbreon VMAX', 'type' => 'card'],
            ['name' => 'Giratina VSTAR', 'type' => 'card'],
            ['name' => 'Arceus VSTAR', 'type' => 'card'],
            ['name' => 'Espeon VMAX', 'type' => 'card'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

