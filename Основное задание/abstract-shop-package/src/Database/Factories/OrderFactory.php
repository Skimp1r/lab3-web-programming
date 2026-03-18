<?php

namespace Bystrov\AbstractShop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Bystrov\AbstractShop\Models\Order;
use Bystrov\AbstractShop\Models\Customer;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::query()->inRandomOrder()->value('id'),
            'status' => 'NEW',
            'currency' => 'RUB',
            'total' => 0,
            'from_address' => $this->faker->address(),
            'to_address' => $this->faker->address(),
            'delivery_distance_km' => null,
            'delivery_price' => null,
        ];
    }
}

