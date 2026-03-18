<?php

namespace Bystrov\AbstractShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Bystrov\AbstractShop\Database\Factories\WarehouseFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'abstract_shop_warehouses';

    protected $fillable = [
        'name',
        'address',
    ];

    protected static function newFactory()
    {
        return WarehouseFactory::new();
    }
}

