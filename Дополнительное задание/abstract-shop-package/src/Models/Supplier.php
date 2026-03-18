<?php

namespace Bystrov\AbstractShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Bystrov\AbstractShop\Database\Factories\SupplierFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'abstract_shop_suppliers';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected static function newFactory()
    {
        return SupplierFactory::new();
    }
}

