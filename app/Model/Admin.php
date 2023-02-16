<?php

declare(strict_types=1);

namespace App\Model;

final class Admin extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'Admin';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
