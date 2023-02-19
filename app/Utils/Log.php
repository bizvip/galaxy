<?php

/******************************************************************************
 * Copyright (c) 2022. Archer                                                 *
 ******************************************************************************/

namespace App\Utils;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

/**
 * @method static void error(array|string $logData, string $channel = null)
 * @method static void info(array|string $logData, string $channel = null)
 * @method static void debug(array|string $logData, string $channel = null)
 * @method static void alert(array|string $logData, string $channel = null)
 */
final class Log
{
    public static function __callStatic($method, array $args)
    {
        $channel = $args[1] ?? config('app_env');
        try {
            $text = is_array($args[0]) ?
                json_encode($args[0], JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : $args[0];

            echo PHP_EOL, '>>>>>> '.strtoupper($method), ' ', \DateTime::createFromFormat('U.u', microtime(true))
                ->format('Y-m-d H:i:s.u'), ' >>>>>> ', PHP_EOL, $text, PHP_EOL, '<<<<<< '.strtoupper(
                    $method
                ), ' <<<<<< ', PHP_EOL, PHP_EOL;

            ApplicationContext::getContainer()->get(LoggerFactory::class)->get($channel)->{$method}(
                $text
            );
        } catch (\Throwable $e) {
            throw new \RuntimeException('Log __callStatic : '.$e->getTraceAsString());
        }
    }
}
