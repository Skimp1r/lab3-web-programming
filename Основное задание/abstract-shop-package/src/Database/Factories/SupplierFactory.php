<?php

namespace Bystrov\AbstractShop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Bystrov\AbstractShop\Models\Supplier;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}

