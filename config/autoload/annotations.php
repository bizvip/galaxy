<?php

declare(strict_types=1);

return [
    'scan' => [
        'paths'              => [
            BASE_PATH.'/app',
        ],
        'ignore_annotations' => [
            'mixin', 'OA\Info', 'Info', 'OA\Post', 'OA\Response', 'OA\Put', 'OA\Items',
            'OA\Parameter', 'OA\RequestBody', 'OA\Schema', 'OA\JsonContent',
            'OA\Property', 'OA\Get', 'OA\SecurityScheme', 'OA\Tag', 'OA\OpenApi',
            'OA\Components', 'OA\Attachable', 'OA\Server', 'OA\ServerVariable',
            'OA\MediaType',
        ],
    ],
];
