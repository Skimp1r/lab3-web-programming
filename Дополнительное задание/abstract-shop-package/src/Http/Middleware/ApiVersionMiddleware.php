<?php

namespace Bystrov\AbstractShop\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiVersionMiddleware
{
    public function handle(Request $request, Closure $next, ?string $expectedVersion = null)
    {
        $expected = $expectedVersion !== null && $expectedVersion !== ''
            ? $expectedVersion
            : (string) config('abstract-shop.api.version', 1);

        $header = $request->header('X-API-VERSION');
        if ($header === null || $header === '') {
            return response()->json([
                'error' => 'X-API-VERSION header is required',
                'expected' => (int) $expected,
            ], 400);
        }

        if (!preg_match('/^\d+$/', (string) $header)) {
            return response()->json([
                'error' => 'X-API-VERSION must be numeric',
                'got' => (string) $header,
            ], 400);
        }

        if ((int) $header !== (int) $expected) {
            return response()->json([
                'error' => 'Unsupported API version',
                'expected' => (int) $expected,
                'got' => (int) $header,
            ], 426);
        }

        return $next($request);
    }
}

