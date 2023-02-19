<?php

/******************************************************************************
 * Copyright (c) 2022. Archer                                                 *
 ******************************************************************************/

namespace App\Utils;

use Hyperf\Contract\PackerInterface;

final class BinPacker implements PackerInterface
{
    public static function serialize(mixed $data): string
    {
        return \igbinary_serialize($data);
    }

    public static function unserialize(string $key): mixed
    {
        return \igbinary_unserialize($key);
    }

    public function pack($data): string
    {
        return \igbinary_serialize($data);
    }

    public function unpack(string $data): mixed
    {
        return \igbinary_unserialize($data);
    }
}
