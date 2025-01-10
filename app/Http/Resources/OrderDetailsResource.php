<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Constants\MediaCollection;
use App\Http\Resources\Media\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];

        if($request->routeIs('customer.orders.details'))
        {
            $data['product_name']       = $this->name;
            $data['product_description']       = $this->description;
            $data['product_price']       = $this->pivot->old_price;
            // $data['product_name']       =  $this->product->name; 
            $data['product_image']      =  MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::PRODUCT_COLLECTION
                )
            );
            $data['quantity']           =  $this->pivot->quantity; 
            $data['total_price']        =  $this->pivot->total_price; 
        }

        return $data;
    }
}
