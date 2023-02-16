<?php

declare(strict_types=1);

return [
    'handler' => [
        'http' => [
            \Qbhy\HyperfAuth\AuthExceptionHandler::class,
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
        ],
    ],
];
