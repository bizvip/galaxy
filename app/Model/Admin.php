<?php

declare(strict_types=1);

namespace App\Model;

use Qbhy\HyperfAuth\Authenticatable;

/**
 * @property int            $id
 * @property string         $usr          用户名
 * @property string         $pwd          密码
 * @property string         $nickname     昵称
 * @property string         $googleSecret otp密钥
 * @property string         $googleQrcode otp二维码
 * @property int            $roleId       权限组id
 * @property int            $isEnabled    是否启用
 * @property \Carbon\Carbon $createdAt
 * @property \Carbon\Carbon $updatedAt
 */
final class Admin extends Model implements Authenticatable
{
    protected ?string $table = 'admin';

    protected array $fillable = [
        'id',
        'usr',
        'pwd',
        'nickname',
        'google_secret',
        'google_qrcode',
        'role_id',
        'is_enabled',
        'created_at',
        'updated_at',
    ];

    protected array $casts = [
        'id'         => 'integer',
        'role_id'    => 'integer',
        'is_enabled' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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
