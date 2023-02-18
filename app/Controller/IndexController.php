<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Contract\ConfigInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\Utils\ApplicationContext;

#[Controller]
final class IndexController extends AbstractController
{
    #[GetMapping('/')]
    public function index(): array
    {
        $method = $this->request->getMethod();

        $conf = ApplicationContext::getContainer()->get(ConfigInterface::class);

        $value = ($conf->get('galaxy'));

        return [
            'indexController' => $value,
            'auth'            => $this->authManager->guard(),
            'id'              => $this->authManager->getGuards(),
            'method'          => $method,
        ];
    }

    #[GetMapping('/test')]
    public function login(): array
    {
        return ['jdsaofijsdaoifoisadfjiosad' => 'jdfijasdiofodsajfoasdjioijo'];
    }
}
