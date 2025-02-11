<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    // protected $table = 'orders';
    // protected $dateFormat = 'Y-m-d';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Product::class , 'order_variants')->withPivot('quantity' , 'total_price' , 'old_price');
    }


}
