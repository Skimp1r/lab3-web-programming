<?php

namespace Bystrov\AbstractShop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Bystrov\AbstractShop\Models\Warehouse;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        return [
            'name' => 'Склад ' . $this->faker->city(),
            'address' => $this->faker->address(),
        ];
    }
}

