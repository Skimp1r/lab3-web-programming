<?php

namespace Bystrov\AbstractShop\Facades;

use Illuminate\Support\Facades\Facade;
use Bystrov\AbstractShop\Services\CurrencyRateService;

/**
 * @method static float rate(string $to, ?string $from = null)
 * @method static array rates(array $to, ?string $from = null)
 */
class CurrencyRate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CurrencyRateService::class;
    }
}

