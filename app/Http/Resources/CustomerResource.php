<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Constants\MediaCollection;
use App\Http\Resources\Media\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
        if($request->routeIs('customer.profile'))
        {
            $data['first_name'] = $this->first_name;
            $data['last_name'] = $this->last_name;
            $data['email'] = $this->email;
            $data['phone'] = $this->phone;
            $data['address_name'] = $this->address_name;
            $data['image'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::CUSTOMER_COLLECTION
                )
            );
        }

        // dd($data['image']);

        return $data;
    }
}
