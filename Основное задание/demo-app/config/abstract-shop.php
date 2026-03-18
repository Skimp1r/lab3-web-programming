<?php

return [
    /*
     |----------------------------------------------------------------------
     | Внутренний префикс маршрутов пакета
     |----------------------------------------------------------------------
     | Пример: 'shop' => маршруты будут доступны как /shop/products, ...
     */
    'route_prefix' => env('ABSTRACT_SHOP_ROUTE_PREFIX', 'shop'),

    /*
     |----------------------------------------------------------------------
     | Курс валют
     |----------------------------------------------------------------------
     | base — базовая валюта
     | provider — источник курса (free): 'exchangerate_host' | 'cbr' | 'mock'
     */
    'currency' => [
        'base' => env('ABSTRACT_SHOP_CURRENCY_BASE', 'RUB'),
        'provider' => env('ABSTRACT_SHOP_CURRENCY_PROVIDER', 'exchangerate_host'),
        'timeout_seconds' => 5,
    ],

    /*
     |----------------------------------------------------------------------
     | Доставка
     |----------------------------------------------------------------------
     | provider: 'osrm' | 'openrouteservice' | 'haversine'
     | openrouteservice_key — если выбран openrouteservice
     */
    'delivery' => [
        'provider' => env('ABSTRACT_SHOP_DELIVERY_PROVIDER', 'osrm'),
        'openrouteservice_key' => env('ABSTRACT_SHOP_ORS_KEY', ''),
        'price_per_km' => (float) env('ABSTRACT_SHOP_PRICE_PER_KM', 25.0),
        'timeout_seconds' => 8,
    ],
];

