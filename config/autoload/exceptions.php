<?php

declare(strict_types=1);

return [
    'handler' => [
        'http' => [
            \App\Exception\Handler\AuthExceptionHandler::class,
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            App\Exception\Handler\OthersExceptionHandler::class,
        ],
    ],
];
