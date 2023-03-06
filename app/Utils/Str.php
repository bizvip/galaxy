<?php
/******************************************************************************
 * Copyright (c) 2022. Archer                                                 *
 ******************************************************************************/

declare(strict_types=1);

namespace App\Utils;

final class Str extends \Hyperf\Utils\Str
{
    public static function pure($v): string|array|int|bool
    {
        if (is_int($v) || is_bool($v)) {
            return $v;
        }
        return str_ireplace([' ', "'", "\"", "\r", "\t", "\r\n"], '', $v);
    }

    public static function getFQCNModelNameByIndex(string $index): string
    {
        return 'App\Model\\'.ucfirst(self::camel($index));
    }

    // public static function idToHex($i): string
    // {
    //     return str_pad(dechex($i), 6, 'xx', STR_PAD_LEFT);
    // }
    //
    // public static function hexToId(string $hex): int
    // {
    //     $hex = str_ireplace(['x', 'X'], '', $hex);
    //     return \ctype_xdigit($hex) ? hexdec($hex) : 0;
    // }

    public static function idToHash(int|string|array $id, string $salt = '', int $length = 0, string $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890', bool $isHex = false): string
    {
        $hi = new \Hashids\Hashids($salt, $length, $alphabet);
        return $isHex ? $hi->encodeHex($id) : $hi->encode($id);
    }

    public static function hashToId(
        string $hash,
        string $salt = '',
        int $length = 0,
        string $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        bool $isHex = false,
    ): string|array {
        $hi = new \Hashids\Hashids($salt, $length, $alphabet);
        return $isHex ? $hi->decodeHex($hash) : $hi->decode($hash);
    }

    public static function toPassword(string $pwd): string
    {
        return \password_hash(strtolower($pwd), PASSWORD_ARGON2ID);
    }

    public static function verifyPassword(string $hash, string $pwd): bool
    {
        return \password_verify(strtolower($pwd), $hash);
    }
}
