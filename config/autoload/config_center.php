<?php

declare(strict_types=1);

use Hyperf\ConfigCenter\Mode;

return [
    'enable'  => (bool) env('CONFIG_CENTER_ENABLE', true),
    'driver'  => env('CONFIG_CENTER_DRIVER', 'etcd'),
    'mode'    => env('CONFIG_CENTER_MODE', Mode::PROCESS),
    'drivers' => [
        // 'etcd' => [
        //     'driver' => Hyperf\ConfigEtcd\EtcdDriver::class,
        //     'packer' => Hyperf\Utils\Packer\JsonPacker::class,
        //     'namespaces' => [
        //         '/application',
        //     ],
        //     'mapping' => [
        //         // etcd key => config key
        //         '/application/test' => 'test',
        //     ],
        //     'interval' => 5,
        // ],
        'nacos' => [
            'driver'          => Hyperf\ConfigNacos\NacosDriver::class,
            // 配置合并方式，支持覆盖和合并
            'merge_mode'      => Hyperf\ConfigNacos\Constants::CONFIG_MERGE_OVERWRITE,
            'interval'        => 5,
            // 如果对应的映射 key 没有设置，则使用默认的 key
            'default_key'     => 'galaxy-api-conf',
            'listener_config' => [
                // dataId, group, tenant, type, content
                // 映射后的配置 KEY => Nacos 中实际的配置
                'nacos_config'      => [
                    'tenant'  => 'public',
                    'data_id' => 'galaxy-1',
                    'group'   => 'DEFAULT_GROUP',
                ],
                'nacos_config.data' => [
                    'data_id' => 'galaxy-1',
                    'group'   => 'DEFAULT_GROUP',
                    'type'    => 'json',
                ],
            ],
        ],
    ],
];
