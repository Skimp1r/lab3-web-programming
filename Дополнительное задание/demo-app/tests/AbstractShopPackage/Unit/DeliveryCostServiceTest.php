<?php

namespace Tests\AbstractShopPackage\Unit;

use Tests\AbstractShopPackage\TestCase;
use Bystrov\AbstractShop\Services\DeliveryCostService;

class DeliveryCostServiceTest extends TestCase
{
    public function testHaversineProviderWorksWithCoords(): void
    {
        $svc = new DeliveryCostService([
            'provider' => 'haversine',
            'price_per_km' => 10.0,
            'timeout_seconds' => 1,
        ]);

        // Moscow -> Tver (coords)
        $res = $svc->estimate('55.7558,37.6173', '56.8587,35.9176');

        $this->assertSame('haversine', $res['provider']);
        $this->assertIsFloat($res['distance_km']);
        $this->assertGreaterThan(100.0, $res['distance_km']);
        $this->assertGreaterThan(0.0, $res['price']);
        $this->assertEqualsWithDelta($res['distance_km'] * 10.0, $res['price'], 0.01);
    }
}

