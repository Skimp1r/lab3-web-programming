<?php

namespace Tests\AbstractShopPackage\Unit;

use Tests\AbstractShopPackage\TestCase;
use Bystrov\AbstractShop\Services\CurrencyRateService;
use Illuminate\Support\Facades\Http;

class CurrencyRateServiceTest extends TestCase
{
    public function testMockProviderReturnsOne(): void
    {
        $svc = new CurrencyRateService([
            'base' => 'RUB',
            'provider' => 'mock',
            'timeout_seconds' => 1,
        ]);
        $this->assertSame(1.0, $svc->rate('USD'));
    }

    public function testExchangerateHostParsesRate(): void
    {
        Http::fake([
            'https://api.exchangerate.host/latest*' => Http::response([
                'base' => 'RUB',
                'rates' => ['USD' => 0.0123],
            ], 200),
        ]);

        $svc = new CurrencyRateService([
            'base' => 'RUB',
            'provider' => 'exchangerate_host',
            'timeout_seconds' => 1,
        ]);

        $this->assertEqualsWithDelta(0.0123, $svc->rate('USD', 'RUB'), 0.0000001);
    }
}

