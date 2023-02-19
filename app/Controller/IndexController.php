<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Admin;
use App\Utils\Str;
use Hyperf\Contract\ConfigInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\Utils\ApplicationContext;
use OpenApi\Annotations as OA;

#[Controller(prefix: '/api/v1')]
final class IndexController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/v1/front/agent/levels",
     *     tags={"Agent"},
     *     summary="讀取代理層級",
     *     operationId="user-profile",
     *
     *     @OA\Response(response="200",description="successfully",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/200")),
     *     @OA\Response(response="400",description="Business Exception",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/400")),
     *     @OA\Response(response="429",description="Rate Limit",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/429")),
     *     @OA\Response(response="500",description="Server Internal Error",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/500")),
     *     @OA\Response(response="503",description="Service Unavailable",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/503"))
     * )
     */
    #[GetMapping('/')]
    public function index(): array
    {
        $conf  = ApplicationContext::getContainer()->get(ConfigInterface::class);
        $value = ($conf->get('galaxy'));

        $hash = Str::idToHash(63456);

        $admin = Admin::retrieveById('root');
        $token = $this->auth->login($admin);

        return [
            'token'           => $token,
            'indexController' => $value,
            'guard'           => $this->auth->user($token),
            'auth:id'         => $this->auth->id($token),
            'check'           => $this->auth->check(),
            'logout'          => $this->auth->logout(),
            'getName'         => $this->auth->getName(),
            'getGuards'       => $this->auth->getGuards(),
            'getProvider'     => $this->auth->getProvider(),
            'provider'        => $this->auth->provider(),
            'hash'            => $hash,
            'id'              => Str::hashToId(hash: $hash),
        ];
    }

    #[GetMapping(path: 'token')]
    public function login(): array
    {
        return ['jdsaofijsdaoifoisadfjiosad' => 'jdfijasdiofodsajfoasdjioijo'];
    }
}
