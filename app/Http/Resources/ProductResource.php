<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Constants\MediaCollection;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Media\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id  
        ];

        if(
            $request->routeIs('store.details') ||
            $request->routeIs('product.viewed') ||
            $request->routeIs('product.preferred') ||
            $request->routeIs('product.selled') ||
            $request->routeIs('product.home') ||
            $request->routeIs('customer.search') ||
            $request->routeIs('products.fav')
        )
        {
            $data['name'] = $this->name;
            $data['price'] = $this->price;
            $data['image'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::PRODUCT_COLLECTION
                )
            );
            $data['is_favorite']  = (Auth::guard('customer')->check()) ?
            $this->favourites()->where('customer_id', Auth::guard('customer')->user()->id)->exists() : null;

            // $data['is_favorite']  = $this->favourites()->where('customer_id', )->exists();
        }
        if($request->routeIs('product.details'))
        {
            $data['name'] = $this->name;
            $data['description'] = $this->description;
            $data['price'] = $this->price;
            $data['image'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::PRODUCT_COLLECTION
                )
            );
            $data['is_favorite']  = (Auth::guard('customer')->check()) ?
            $this->favourites()->where('customer_id', Auth::guard('customer')->user()->id)->exists() : null;

            $data['number_of_preferences'] = $this->number_of_preferences;
            $data['number_of_views']       = $this->number_of_views;
            $data['number_of_orders']      = $this->number_of_orders;
            $data['quantity']              = $this->quantity;
        }

        return $data;
    }
}
