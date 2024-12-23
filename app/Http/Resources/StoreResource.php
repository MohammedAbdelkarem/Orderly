<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Constants\MediaCollection;
use App\Http\Resources\Media\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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

        if($request->routeIs('store.all') ||
            $request->routeIs('store.home') ||
            $request->routeIs('customer.search') 
        )
        {
            $data['name'] = $this->name;
            $data['description'] = $this->description;
            $data['logo'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::STORE_LOGO_COLLECTION
                )
            );
            $data['cover_image'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::STORE_COVER_IMAGE_COLLECTION
                )
            );
        }
        if($request->routeIs('store.details')
        )
        {
            $data['name'] = $this->name;
            $data['description'] = $this->description;
            $data['logo'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::STORE_LOGO_COLLECTION
                )
            );
            $data['cover_image'] = MediaResource::make(
                $this->getFirstMedia(
                    MediaCollection::STORE_COVER_IMAGE_COLLECTION
                )
            );
            $data['products'] = ProductResource::collection($this->whenLoaded('products'));
        }

        return $data;
    }
}
