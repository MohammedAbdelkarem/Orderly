<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderVariant extends Pivot
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'order_variants';
}
