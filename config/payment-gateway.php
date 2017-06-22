<?php

return [
    'base_uri' => env('PG_BASE_URI', 'payment-gateway.netearth.net'),
    'version' => env('PG_VERSION', 'v1'),
    'mode' => env('PG_MODE', 'live'),
    'live' => [
        'app' => env('PG_LIVE_APP', ''),
        'key' => env('PG_LIVE_KEY', '')
    ],
    'test' => [
        'app' => env('PG_TEST_APP', ''),
        'key' => env('PG_TEST_KEY', '')
    ]
];