<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove this recursive call (it's causing the issue)
        // $this->call(ProductSeeder::class);
        
        $products = [
            [
                'name' => 'Johnnie Walker Black Label',
                'price' => 39.99,
                'description' => 'Blended Scotch Whisky with rich fruit and smoky flavors',
                'stock' => 45,
                'category' => 'Whisky'
            ],
            // ... keep the rest of your products array
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}