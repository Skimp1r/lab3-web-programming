<?php

namespace Bystrov\AbstractShop\Database\Seeders;

use Illuminate\Database\Seeder;
use Bystrov\AbstractShop\Models\Category;
use Bystrov\AbstractShop\Models\Supplier;
use Bystrov\AbstractShop\Models\Customer;
use Bystrov\AbstractShop\Models\Warehouse;
use Bystrov\AbstractShop\Models\Product;

class AbstractShopSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->count(6)->create();
        Supplier::factory()->count(5)->create();
        Customer::factory()->count(10)->create();
        Warehouse::factory()->count(2)->create();
        Product::factory()->count(30)->create();
    }
}

