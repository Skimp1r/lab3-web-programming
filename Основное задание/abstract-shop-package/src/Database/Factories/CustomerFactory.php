<?php

namespace Bystrov\AbstractShop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Bystrov\AbstractShop\Models\Customer;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}

