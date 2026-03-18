<?php

namespace Tests\AbstractShopPackage\Unit;

use Tests\AbstractShopPackage\TestCase;

class ApiVersionMiddlewareTest extends TestCase
{
    public function testMissingHeaderReturns400(): void
    {
        $this->app['router']->get('/t', fn () => response()->json(['ok' => true]))
            ->middleware('api.version');

        $this->getJson('/t')->assertStatus(400)->assertJsonFragment([
            'error' => 'X-API-VERSION header is required',
            'expected' => 1,
        ]);
    }

    public function testNonNumericHeaderReturns400(): void
    {
        $this->app['router']->get('/t2', fn () => response()->json(['ok' => true]))
            ->middleware('api.version');

        $this->getJson('/t2', ['X-API-VERSION' => 'abc'])->assertStatus(400)->assertJsonFragment([
            'error' => 'X-API-VERSION must be numeric',
        ]);
    }

    public function testVersionMismatchReturns426(): void
    {
        $this->app['router']->get('/t3', fn () => response()->json(['ok' => true]))
            ->middleware('api.version:2');

        $this->getJson('/t3', ['X-API-VERSION' => '1'])->assertStatus(426)->assertJsonFragment([
            'error' => 'Unsupported API version',
            'expected' => 2,
            'got' => 1,
        ]);
    }

    public function testCorrectVersionPasses(): void
    {
        $this->app['router']->get('/t4', fn () => response()->json(['ok' => true]))
            ->middleware('api.version');

        $this->getJson('/t4', ['X-API-VERSION' => '1'])->assertOk()->assertJson(['ok' => true]);
    }
}

