<?php

namespace Bystrov\AbstractShop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Bystrov\AbstractShop\Models\Product;
use Bystrov\AbstractShop\Models\Category;
use Bystrov\AbstractShop\Models\Supplier;
use Bystrov\AbstractShop\Models\Warehouse;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-#####')),
            'price' => $this->faker->randomFloat(2, 10, 5000),
            'currency' => 'RUB',
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'supplier_id' => Supplier::query()->inRandomOrder()->value('id'),
            'warehouse_id' => Warehouse::query()->inRandomOrder()->value('id'),
            'stock' => $this->faker->numberBetween(0, 200),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}

