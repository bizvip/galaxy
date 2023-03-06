<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\BusinessException;
use App\Model\Admin;
use App\Request\PostAuthTokenRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use OpenApi\Annotations as OA;

#[Controller(prefix: '/api/v1/auth')]
final class AuthController extends AbstractController
{
    #[GetMapping('/')]
    public function index(): array
    {
        // $conf  = $this->container->get(ConfigInterface::class);
        // $value = ($conf->get('galaxy'));

        // $hash = Str::idToHash(63456);
        //
        // $admin = Admin::retrieveById('root');
        // $token = $this->auth->login($admin);

        $admin = Admin::query()->where(['usr' => 'root'])->first();

        return [
            // 'token'           => $token,
            // 'indexController' => $value,
            // 'guard'           => $this->auth->user($token),
            // 'auth:id'         => $this->auth->id($token),
            // 'check'           => $this->auth->check(),
            // 'logout'          => $this->auth->logout(),
            // 'getName'         => $this->auth->getName(),
            // 'getGuards'       => $this->auth->getGuards(),
            // 'getProvider'     => $this->auth->getProvider(),
            // 'provider'        => $this->auth->provider(),
            // 'hash'            => $hash,
            // 'id'              => Str::hashToId(hash: $hash),
            'admin' => $admin,
        ];
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/token",
     *     tags={"Auth","Token"},
     *     summary="add new token",
     *     operationId="auth-token-add",
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(description="后台账号登陆",
     *         @OA\JsonContent(type="object", required={"usr","pwd","otp_code"},
     *             @OA\Property(property="usr", type="string", example="root"),
     *             @OA\Property( property="pwd", type="string",
     *                           example="200820E3227815ED1756A6B531E7E0D2",
     *                           description="客户端需要发送md5"),
     *             @OA\Property(property="otp_code", type="string", example="348591"),
     *         ),
     *     ),
     *
     *     @OA\Response(response="200",description="successfully",
     *         @OA\JsonContent(type="object",ref="#/components/schemas/200")),
     *     @OA\Response(response="429",description="Rate Limit",
     *         @OA\JsonContent(type="object",ref="#/components/schemas/429")),
     *     @OA\Response(response="500",description="Server Internal Error",
     *         @OA\JsonContent(type="object",ref="#/components/schemas/500")),
     * )
     */
    #[PostMapping(path: 'token')]
    public function addToken(PostAuthTokenRequest $request): array
    {
        $admin = Admin::retrieveById($request->post('usr', ''));
        if (!$admin) {
            throw new BusinessException(200, '您的账号或密码不正确');
        }

        $token = $this->auth->login($admin);

        return ['token' => $token];
    }
}
