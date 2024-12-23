<?php

namespace App\Http\Services;

use App\Constants\Resources;
use App\Http\Traits\ModelHelper;
use stdClass;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;


class ProductService extends BaseService 
{
    public function getHomePageProducts()
    {
        $response = new stdClass;

        $response->most_viewed   = $this->getAllMostViewedProducts()->take(8);
        // dd($response->most_viewed);
        $response->most_preferred   = $this->getAllMostPreferredProducts()->take(8);
        $response->best_seller   = $this->getAllBestSellerProducts()->take(8);
        // dd($response);
        return $response;

   
    }

    public function getAllMostViewedProducts()
    {
        $products = Product::orderBy('number_of_views' , 'desc')
                         ->with('media')
                         ->take(20)
                         ->get();

        return $products;
    }
    public function getAllMostPreferredProducts()
    {
        $products = Product::orderBy('number_of_preferences' , 'desc')
                         ->with('media')
                         ->take(20)
                         ->get();

        return $products;
    }
    public function getAllBestSellerProducts()
    {
        $products = Product::orderBy('number_of_orders' , 'desc')
                         ->with('media')
                         ->take(20)
                         ->get();

        return $products;
    }

    public function getProductDetails($id)
    {
        DB::beginTransaction();
        
        $product = ModelHelper::findByIdOrFail(Product::class , $id , 'male' , Resources::RES_PRODUCT);

        $product->number_of_views++;

        $product->save();

        DB::commit();

        return $product;
    }
    public function search($searchTerm)
    {
        $response = new stdClass;

        $response->products = Product::where('name' , 'LIKE' , "%{$searchTerm}%")
                                        ->orWhere('description' , 'LIKE' , "%{$searchTerm}%")
                                        ->get();

        $response->stores = Store::where('name' , 'LIKE' , "%{$searchTerm}%")
                                        ->orWhere('description' , 'LIKE' , "%{$searchTerm}%")
                                        ->get();

        return $response;
    }

}
