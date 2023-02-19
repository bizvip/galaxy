<?php

declare(strict_types=1);

use Hyperf\Database\Seeders\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        if (!\App\Model\Admin::where(['usr' => 'root'])->exists()) {
            $a            = new \App\Model\Admin();
            $a->usr       = 'root';
            $a->nickname  = '大屌萌妹';
            $a->pwd       = \password_hash('qwe123', PASSWORD_ARGON2ID);
            $a->head_img  = \Hyperf\Utils\ApplicationContext::getContainer()->get(HeadImgSvc::class)
                ->getRandomHeadImg();
            $a->role_name = '超級管理員';
            $a->save();
        }
    }
}
