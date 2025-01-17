<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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

        if($request->routeIs('customer.orders') || $request->routeIs('customer.orders.details'))
        {
            $data['order_number']       = $this->order_number;
            $data['total_quantity']     = $this->total_quantity;
            $data['total_price']        = $this->total_price;
            $data['status']             = $this->status;
            $data['total_quantity']     = $this->total_quantity;
            $data['creation_date']      = $this->created_at->format('Y-m-d');
            $data['last_update']        = $this->updated_at->format('Y-m-d');

            if($request->routeIs('customer.orders.details'))
            {
                // $data['details'] = $this->variants;
                $data['details'] = OrderDetailsResource::collection($this->variants);
            }
        }

        return $data;
    }
}
