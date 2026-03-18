<?php

namespace Bystrov\AbstractShop;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Bystrov\AbstractShop\Http\Middleware\ApiVersionMiddleware;

class AbstractShopServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/abstract-shop.php', 'abstract-shop');

        $this->app->singleton(Services\CurrencyRateService::class, function () {
            return new Services\CurrencyRateService(config('abstract-shop.currency'));
        });

        $this->app->singleton(Services\DeliveryCostService::class, function () {
            return new Services\DeliveryCostService(config('abstract-shop.delivery'));
        });
    }

    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('api.version', ApiVersionMiddleware::class);

        $this->publishes([
            __DIR__ . '/../config/abstract-shop.php' => config_path('abstract-shop.php'),
        ], 'abstract-shop-config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'abstract-shop');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/abstract-shop'),
        ], 'abstract-shop-views');

        // Доп. задание: публикация unit-тестов пакета в приложение
        $this->publishes([
            __DIR__ . '/../tests' => base_path('tests/AbstractShopPackage'),
            __DIR__ . '/../phpunit.xml.dist' => base_path('phpunit-abstract-shop.xml'),
        ], 'abstract-shop-tests');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $prefix = (string) config('abstract-shop.route_prefix', 'shop');
        Route::middleware(['web'])
            ->prefix($prefix)
            ->group(__DIR__ . '/../routes/web.php');

        $apiPrefix = (string) config('abstract-shop.api.prefix', 'api/shop');
        Route::middleware(['api'])
            ->prefix($apiPrefix)
            ->group(__DIR__ . '/../routes/api.php');
    }
}

