<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

/**
 * ProductSeeder
 *
 * Seeds products with real Pokémon cards, packs, and boxes with working image URLs.
 */
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // BOXES
            ['name' => 'Scarlet & Violet Booster Box', 'type' => 'box', 'image_url' => 'https://m.media-amazon.com/images/I/91hUKX-tu5L._AC_UF894,1000_QL80_.jpg'],
            ['name' => 'Paldea Evolved Booster Box', 'type' => 'box', 'image_url' => 'https://www.supercollectors.es/wp-content/uploads/2024/03/pokemon_tcg_scarlet_violet_paldea_evolved_elite_trainer_box.webp'],
            ['name' => 'Obsidian Flames Booster Box', 'type' => 'box', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/d2905b07976783b305eb4770493a0bf2baa76a29af8c034e110c193f3919b9ba/1600.jpg'],
            ['name' => 'Paradox Rift Booster Box', 'type' => 'box', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/a349b4813e9c78d60e47a28d3ad7eb8d259f2de84fe4fa9cdf6e6c411c19df49/1600.jpg'],
            ['name' => 'Temporal Forces Booster Box', 'type' => 'box', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/4fbe4dff0849444e52fb7aa13fe52781770adbe24cbf9fcd9cbf12aa5d3327df/1600.jpg'],
            ['name' => 'Evolving Skies Booster Box', 'type' => 'box', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/1d53b2174ffd9baeadc62527270258c117f0a5087894ecef387ff96810e4eaa2/1600.jpg'],
            ['name' => 'Brilliant Stars Booster Box', 'type' => 'box', 'image_url' => 'https://sidekicks.co.uk/cdn/shop/files/Pokemon-TCG-Sword-Shield-Brilliant-Stars-Booster-Box-Product.webp?v=1750461020'],
            ['name' => 'Lost Origin Booster Box', 'type' => 'box', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/gd6mivft4qcajxyo/1600.jpg'],
            ['name' => 'Fusion Strike Booster Box', 'type' => 'box', 'image_url' => 'https://tcgplayer-cdn.tcgplayer.com/product/247655_in_1000x1000.jpg'],
            ['name' => 'Crown Zenith Booster Box', 'type' => 'box', 'image_url' => 'https://m.media-amazon.com/images/I/61S0G8AHUtL._AC_UF894,1000_QL80_.jpg'],

            // PACKS
            ['name' => 'Scarlet & Violet Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Pokemon-Scarlet-Violet-Booster-Pack-4.jpg?v=1726415293&width=1214'],
            ['name' => 'Paldea Evolved Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Pokemon-Paldea-Evolved-Booster-Pack-2.jpg?v=1726410603&width=1214'],
            ['name' => 'Obsidian Flames Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Obsidian_Flames_booster_pack_4.jpg?v=1707950142&width=1214'],
            ['name' => 'Paradox Rift Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Pokemon-paradox-Rift-Booster-Pack-4.jpg?v=1725977255&width=1214'],
            ['name' => 'Temporal Forces Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Temporal_Forces_Booster_pack.jpg?v=1707949683&width=1214'],
            ['name' => 'Evolving Skies Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Pokemon-Evolving-Skies-booster-pack-01.jpg?v=1731231960&width=1214'],
            ['name' => 'Brilliant Stars Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Pokemon-Brilliant-Stars-booster-pack-01.jpg?v=1731236660&width=1214'],
            ['name' => 'Lost Origin Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Lost-Origin-Sleeved-Booster-Pack-1.jpg?v=1734455436&width=1214'],
            ['name' => 'Fusion Strike Booster Pack', 'type' => 'pack', 'image_url' => 'https://card-binder.com/cdn/shop/files/bp_pokemon_fusion_strike_2.webp?v=1725130361&width=1500'],
            ['name' => 'Crown Zenith Booster Pack', 'type' => 'pack', 'image_url' => 'https://poke-power.eu/cdn/shop/files/Crown_Zenith_Booster_Pack.jpg?v=1707939824&width=1214'],

            // CARDS
            ['name' => 'Charizard VMAX', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/pgxwl3soi7bk53ws/530.jpg'],
            ['name' => 'Pikachu V', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/346c3f0c5509dc4875050e26e1cb84f382ac9411a21312e5f8b04ea8d8e91b62/1600.jpg'],
            ['name' => 'Mewtwo GX', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/8695af4eb3416698d535ee1eae3d2f44aabd64e7b713382ae1c29c012e6e5210/1600.jpg'],
            ['name' => 'Rayquaza VMAX', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/04b401e305af09977501c870b98e00b24e015e078448b0dc66dc337980bdcf97/1600.jpg'],
            ['name' => 'Gengar VMAX', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/5b945c11b4c0ce7cacc276d6f2db0339b6dc3d72cc856cd356ff0645b0b22717/1600.jpg'],
            ['name' => 'Lugia VSTAR', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/0c9726db5ace88bad521655616510403eca20755f51eaa0d23e2e96674fda662/1600.jpg'],
            ['name' => 'Umbreon VMAX', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/si2fk63oegktnvha/1600.jpg'],
            ['name' => 'Giratina VSTAR', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/xgwrvccftvhnxlzx/1600.jpg'],
            ['name' => 'Arceus VSTAR', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/vd44v53vkugfsviq/1600.jpg'],
            ['name' => 'Espeon VMAX', 'type' => 'card', 'image_url' => 'https://storage.googleapis.com/images.pricecharting.com/a30fe7ef690c7b1820f764fee206c0ec6093fb6f0206e5d57e974ee0ac330df5/1600.jpg'],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
