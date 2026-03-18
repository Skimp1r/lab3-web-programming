<?php

namespace Bystrov\AbstractShop\Facades;

use Illuminate\Support\Facades\Facade;
use Bystrov\AbstractShop\Services\DeliveryCostService;

/**
 * @method static array estimate(string $from, string $to)
 */
class DeliveryCost extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return DeliveryCostService::class;
    }
}

