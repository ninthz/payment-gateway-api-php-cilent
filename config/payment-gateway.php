<?php

return [
    'tcp' => env('PG_TCP', 'https'),
    'base_uri' => env('PG_BASE_URI', 'idcdeposit.com'),
    'version' => env('PG_VERSION', 'v1'),
    'mode' => env('PG_MODE', 'live'),
    'certificate' => env('PG_CERT', false),
    'live' => [
        'app' => env('PG_LIVE_APP', ''),
        'key' => env('PG_LIVE_KEY', '')
    ],
    'test' => [
        'app' => env('PG_TEST_APP', ''),
        'key' => env('PG_TEST_KEY', '')
    ]
];
