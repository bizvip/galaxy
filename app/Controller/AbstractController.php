<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\Components;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\OpenApi;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\SecurityScheme;
use OpenApi\Attributes\Server;
use OpenApi\Attributes\ServerVariable;
use Psr\Container\ContainerInterface;
use Qbhy\HyperfAuth\AuthManager;

#[Info(version: '0.1', title: 'Galaxy Project OpenApi Documents')]
#[OpenApi(security: ['bearerAuth' => []])]
#[Components(securitySchemes: [new SecurityScheme(securityScheme: 'bearerAuth', type: 'http', scheme: 'bearer')], attachables: [new Attachable()])]
#[Server(url: '{schema}://{ip}:{port}', description: 'swagger server url', variables: [
    new ServerVariable(serverVariable: 'schema', default: 'http', enum: ['http', 'https',]),
    new ServerVariable(serverVariable: 'ip', default: '127.0.0.1', enum: ['127.0.0.1', 'hosts.run',]),
    new ServerVariable(serverVariable: 'port', default: '8888', enum: ['8888', '8000',]),
])]
#[Schema(schema: '200', required: ['code', 'msg', 'data'], properties: [
    new Property(property: 'code', type: 'integer', default: 200),
    new Property(property: 'msg', type: 'string', default: 'Successfully'),
    new Property(property: 'data', type: 'object', default: null),
])]
#[Schema(schema: '400', required: ['code', 'msg', 'data'], properties: [
    new Property(property: 'code', description: '业务错误码', type: 'integer', default: 1000),
    new Property(property: 'msg', type: 'string', default: 'Business Exception'),
    new Property(property: 'data', type: 'object', default: null),
])]
#[Schema(schema: '429', required: ['code', 'msg', 'data'], properties: [
    new Property(property: 'code', type: 'integer', default: 429),
    new Property(property: 'msg', type: 'string', default: 'Rate Limit From Server'),
    new Property(property: 'data', type: 'object', default: null),
])]
#[Schema(schema: '500', required: ['code', 'msg', 'data'], properties: [
    new Property(property: 'code', type: 'integer', default: 500),
    new Property(property: 'msg', type: 'string', default: 'Internal Server Exception'),
    new Property(property: 'data', type: 'object', default: null),
])]
#[Schema(schema: '503', required: ['code', 'msg', 'data'], properties: [
    new Property(property: 'code', type: 'integer', default: 503),
    new Property(property: 'msg', type: 'string', default: 'Server Busy'),
    new Property(property: 'data', type: 'object', default: null),
])]
abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    #[Inject]
    protected AuthManager $auth;
}
