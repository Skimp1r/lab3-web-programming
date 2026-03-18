<?php

namespace Bystrov\AbstractShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Bystrov\AbstractShop\Database\Factories\CustomerFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'abstract_shop_customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }
}

