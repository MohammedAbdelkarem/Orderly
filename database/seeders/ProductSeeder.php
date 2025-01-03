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
                    'name' => 'Product_name_'.$i + $storeId,
                    'description' => 'Product_description_'.$i + $storeId,
                    'price' => $i + $storeId + 10000,
                    'number_of_preferences' => $i + $storeId + 10,
                    'number_of_views' => $i + $storeId + 10,
                    'number_of_orders' => $i + $storeId + 10,
                    'quantity' => $i + $storeId + 100,
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
