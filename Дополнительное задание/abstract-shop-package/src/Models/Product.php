<?php

namespace Bystrov\AbstractShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Bystrov\AbstractShop\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'abstract_shop_products';

    protected $fillable = [
        'name',
        'sku',
        'price',
        'currency',
        'category_id',
        'supplier_id',
        'warehouse_id',
        'stock',
        'description',
    ];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }
}

