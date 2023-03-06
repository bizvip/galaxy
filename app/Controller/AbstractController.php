<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use OpenApi\Annotations as OA;
use Psr\Container\ContainerInterface;
use Qbhy\HyperfAuth\AuthManager;

/**
 * @OA\Info(title="Galaxy Project OpenApi Documents",version="1.0.0")
 * @OA\OpenApi( security={{"bearerAuth": {}}}, )
 * @OA\Server(
 *     url="{schema}://{url}:{port}",
 *     description="OpenApi Location",
 *     @OA\ServerVariable( serverVariable="schema", enum={"https", "http"}, default="http" ),
 *     @OA\ServerVariable( serverVariable="url", enum={"127.0.0.1"}, default="127.0.0.1"),
 *     @OA\ServerVariable( serverVariable="port", enum={8888,8000}, default="8888")
 * )
 * @OA\Components(
 *     @OA\SecurityScheme(securityScheme="bearerAuth",type="http",scheme="bearer",),
 *     @OA\Attachable
 * )
 * @OA\Schema(schema="200", required={"code", "msg","data"},
 *     @OA\Property(property="code", type="integer", default=0, description="正常返回0，当返回4位数字代表具体业务错误码定义"),
 *     @OA\Property(property="msg", type="string", default="successfully"),
 *     @OA\Property(property="data", type="object",default="null")
 * )
 * @OA\Schema(schema="400", required={"code", "msg","data"},
 *     @OA\Property(property="code", type="integer", default=1000, description="未知请求错误"),
 *     @OA\Property(property="msg", type="string", default="something problems"),
 *     @OA\Property(property="data", type="object",default="null")
 * )
 * @OA\Schema(schema="429", required={"code", "msg","data"},
 *     @OA\Property(property="code", type="integer", default=429),
 *     @OA\Property(property="msg", type="string", default="Request Limited"),
 *     @OA\Property(property="data", type="object",default="null")
 * )
 * @OA\Schema(schema="500", required={"code", "msg","data"},
 *     @OA\Property(property="code", type="integer", default=500),
 *     @OA\Property(property="msg", type="string", default="Internal Server Error"),
 *     @OA\Property(property="data", type="object",default="null")
 * )
 * @OA\Schema(schema="503", required={"code", "msg","data"},
 *     @OA\Property(property="code", type="integer", default=503),
 *     @OA\Property(property="msg", type="string", default="Server Busy"),
 *     @OA\Property(property="data", type="object",default="null")
 * )
 */
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
