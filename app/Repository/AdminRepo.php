<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Admin;
use App\Model\Model;
use Hyperf\Di\Annotation\Inject;

final class AdminRepo
{
    #[Inject]
    protected Admin $adminModel;

    public function getAdminByPwd(string $usr, string $pwd): ?Admin
    {
        /** @var \Hyperf\Database\Concerns\BuildsQueries|Model|null|object|Admin $admin */
        $admin = $this->adminModel->newQuery()->where('usr', '=', $usr)->limit(1)->first();
        return !$admin ? null : $admin;
    }
}
