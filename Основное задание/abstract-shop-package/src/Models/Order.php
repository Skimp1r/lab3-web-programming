<?php

namespace Bystrov\AbstractShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Bystrov\AbstractShop\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'abstract_shop_orders';

    protected $fillable = [
        'customer_id',
        'status',
        'currency',
        'total',
        'from_address',
        'to_address',
        'delivery_distance_km',
        'delivery_price',
    ];

    protected static function newFactory()
    {
        return OrderFactory::new();
    }
}

