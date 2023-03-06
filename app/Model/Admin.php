<?php

declare(strict_types=1);

namespace App\Model;

use Qbhy\HyperfAuth\Authenticatable;

/**
 */
final class Admin extends Model implements Authenticatable
{
    protected ?string $table = 'admin';

    protected array $fillable = [];

    protected array $casts = [];

    public function getId(): string
    {
        return $this->usr;
    }

    public static function retrieveById($key): ?Authenticatable
    {
        /** @var null|Admin|Authenticatable $item */
        $item = self::query()->where(['usr' => $key])->limit(1)->first();
        return (!$item || !$item->exists) ? null : $item;
    }
}
