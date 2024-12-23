<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];

        if($request->routeIs('product.home')) {

            $data['most_viewed']        = ProductResource::collection($this->most_viewed);
            $data['most_preferred']     = ProductResource::collection($this->most_preferred);
            $data['best_seller']        = ProductResource::collection($this->best_seller);
        }

        if($request->routeIs('customer.search'))
        {
            $data['stores']             = StoreResource::collection($this->stores);
            $data['products']           = ProductResource::collection($this->products);
        }

        return $data;
    }
}
