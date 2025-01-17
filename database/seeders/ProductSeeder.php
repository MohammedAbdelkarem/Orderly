<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Constants\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($storeId = 1 ; $storeId <= 10 ; $storeId++)
        {
            for($i = 1 ; $i <= 5 ; $i++)
            {
                $product = Product::create([
                    'name' => fake()->name(),
                    'description' => fake()->text(200),
                    'price' => fake()->numberBetween(1000 , 9000),
                    'number_of_preferences' =>  fake()->numberBetween(10 , 1000),
                    'number_of_views' => fake()->numberBetween(10 , 1000),
                    'number_of_orders' => fake()->numberBetween(10 , 1000),
                    'quantity' => fake()->numberBetween(1000 , 9000),
                    'store_id' => $storeId
                ]);
                if($i <= 3)
                {
                    $product->addMediaFromUrl('https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')->toMediaCollection(MediaCollection::PRODUCT_COLLECTION);
                }
            }
        }
    }
}
