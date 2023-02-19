<?php

declare(strict_types=1);

return [
    'default' => [
        'driver'    => env('DB_DRIVER', 'mysql'),
        'host'      => env('DB_HOST', 'localhost'),
        'database'  => env('DB_DATABASE', 'hyperf'),
        'port'      => env('DB_PORT', 3306),
        'username'  => env('DB_USERNAME', 'root'),
        'password'  => env('DB_PASSWORD', ''),
        'charset'   => env('DB_CHARSET', 'utf8mb4'),
        'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
        'prefix'    => env('DB_PREFIX', ''),
        'pool'      => [
            'min_connections' => 10,
            'max_connections' => 100,
            'connect_timeout' => 5.0,
            'wait_timeout'    => 30.0,
            'heartbeat'       => -1,
            'max_idle_time'   => 300.0,
        ],
        'options'   => [
            \PDO::ATTR_CASE              => \PDO::CASE_NATURAL,
            \PDO::ATTR_ERRMODE           => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_ORACLE_NULLS      => \PDO::NULL_NATURAL,
            \PDO::ATTR_STRINGIFY_FETCHES => false,
            \PDO::ATTR_EMULATE_PREPARES  => false,
        ],
        'commands'  => [
            'gen:model' => [
                'path'             => 'app/Model',
                'force_casts'      => true,
                'inheritance'      => 'Model',
                'uses'             => '',
                'table-mapping'    => [],
                'refresh_fillable' => true,
                'with_comments'    => true,
                'property_case'    => \Hyperf\Database\Commands\ModelOption::PROPERTY_CAMEL_CASE,
            ],
        ],
    ],
    // 'pgsql'   => [
    //     'driver'    => env('DB_DRIVER'),
    //     'host'      => env('DB_HOST'),
    //     'database'  => env('DB_DATABASE'),
    //     'port'      => env('DB_PORT'),
    //     'username'  => env('DB_USERNAME'),
    //     'password'  => env('DB_PASSWORD'),
    //     'charset'   => env('DB_CHARSET'),
    //     'collation' => env('DB_COLLATION'),
    //     'prefix'    => env('DB_PREFIX'),
    //     'schema'    => 'public',
    //     'pool'      => [
    //         'min_connections' => 1,
    //         'max_connections' => 64,
    //         'connect_timeout' => 15.0,
    //         'wait_timeout'    => 3.0,
    //         'heartbeat'       => -1,
    //         'max_idle_time'   => (float)env('DB_MAX_IDLE_TIME', 60),
    //     ],
    //     'options'   => [
    //         \PDO::ATTR_CASE              => \PDO::CASE_NATURAL,
    //         \PDO::ATTR_ERRMODE           => \PDO::ERRMODE_EXCEPTION,
    //         \PDO::ATTR_ORACLE_NULLS      => \PDO::NULL_NATURAL,
    //         \PDO::ATTR_STRINGIFY_FETCHES => false,
    //         \PDO::ATTR_EMULATE_PREPARES  => false,
    //     ],
    //     'commands'  => [
    //         'gen:model' => [
    //             'path'             => 'app/Model',
    //             'force_casts'      => true,
    //             'inheritance'      => 'Model',
    //             'uses'             => '',
    //             'table-mapping'    => [],
    //             'refresh_fillable' => true,
    //             'with_comments'    => true,
    //             'property_case'    => \Hyperf\Database\Commands\ModelOption::PROPERTY_CAMEL_CASE,
    //         ],
    //     ],
    // ],
];
