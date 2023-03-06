<?php

/******************************************************************************
 * Copyright (c) 2022. Archer                                                 *
 ******************************************************************************/

declare(strict_types=1);

namespace App\Utils;

final class JSON extends \Hyperf\Utils\Codec\Json
{
    public static function encode($data, int $flags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR, int $depth = 512,): string
    {
        return parent::encode($data, $flags, $depth);
    }

    public static function decode(string $json, bool $assoc = true, int $depth = 512, int $flags = 0): mixed
    {
        return \simdjson_decode($json, $assoc, $depth);
    }
}