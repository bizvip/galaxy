<?php

declare(strict_types=1);

return [
    // 'uri'=>'http://hosts.run',
    'host'     => env('CONFIG_CENTER_HOST'),
    'port'     => env('CONFIG_CENTER_PORT'),
    'username' => 'nacos',
    'password' => '19EuBip2zGZXA004AkqP',
    'guzzle'   => [
        'config' => [
            'headers' => [
                'charset' => 'UTF-8',
            ],
        ],
    ],
];
