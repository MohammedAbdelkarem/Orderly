<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use App\Constants\MediaCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $guarded = [
        'id'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::PRODUCT_COLLECTION);
    }

    public function favourites()
    {
        return $this->belongsToMany(Customer::class , 'favourites');
    }

    public function views()
    {
        return $this->belongsToMany(View::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Order::class , 'order_variants')->withPivot('quantity' , 'total_price');
    }
}
