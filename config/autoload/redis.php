<?php

declare(strict_types=1);

return [
    'default' => [
        'host'    => env('REDIS_HOST', 'localhost'),
        'auth'    => env('REDIS_AUTH', null),
        'port'    => (int)env('REDIS_PORT', 6379),
        'db'      => (int)env('REDIS_DB', 0),
        'pool'    => [
            'min_connections' => 1,
            'max_connections' => 100,
            'connect_timeout' => 25.0,
            'wait_timeout'    => 5.0,
            'heartbeat'       => -1,
            'max_idle_time'   => (float)env('REDIS_MAX_IDLE_TIME', 60),
        ],
        'options' => [
            Redis::OPT_READ_TIMEOUT => -1,
            Redis::OPT_SERIALIZER   => Redis::SERIALIZER_IGBINARY,
        ],
    ],
];
