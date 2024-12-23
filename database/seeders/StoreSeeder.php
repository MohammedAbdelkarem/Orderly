<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Constants\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        for($i = 1 ; $i <= 10 ; $i++)
        {
            $store = Store::create([
                'name' => 'Store_name_'.$i,
                'description' => 'Store_description_'.$i,
                'has_products' => 1,
                'number_of_orders' => $i,
                'number_of_products' => 5
            ]);

            // $store->addMediaFromUrl('https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')->toMediaCollection(MediaCollection::STORE_COVER_IMAGE_COLLECTION);
            // $store->addMediaFromUrl('https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')->toMediaCollection(MediaCollection::STORE_LOGO_COLLECTION);
        }
    }
}
