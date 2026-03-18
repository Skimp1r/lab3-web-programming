<?php

namespace Bystrov\AbstractShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Bystrov\AbstractShop\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'abstract_shop_categories';

    protected $fillable = [
        'name',
        'parent_id',
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}

