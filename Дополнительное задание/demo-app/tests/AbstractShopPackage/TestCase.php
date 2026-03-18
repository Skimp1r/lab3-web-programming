<?php

namespace Tests\AbstractShopPackage;

use Bystrov\AbstractShop\AbstractShopServiceProvider;

if (class_exists(\Orchestra\Testbench\TestCase::class)) {
    abstract class TestCase extends \Orchestra\Testbench\TestCase
    {
        protected function getPackageProviders($app): array
        {
            return [AbstractShopServiceProvider::class];
        }

        protected function defineEnvironment($app): void
        {
            $app['config']->set('abstract-shop.api.version', 1);
            $app['config']->set('abstract-shop.currency.provider', 'mock');
            $app['config']->set('abstract-shop.delivery.provider', 'haversine');
            $app['config']->set('abstract-shop.delivery.price_per_km', 10.0);
        }
    }
} else {
    abstract class TestCase extends \Tests\TestCase
    {
        protected function setUp(): void
        {
            parent::setUp();

            // Ensure package is loaded in the application
            $this->app->register(AbstractShopServiceProvider::class);

            config([
                'abstract-shop.api.version' => 1,
                'abstract-shop.currency.provider' => 'mock',
                'abstract-shop.delivery.provider' => 'haversine',
                'abstract-shop.delivery.price_per_km' => 10.0,
            ]);
        }
    }
}

