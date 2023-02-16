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
        $user   = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $conf = ApplicationContext::getContainer()->get(ConfigInterface::class);

        $value = ($conf->get('galaxy'));

        return [
            '1111'    => $value,
            'auth'    => $this->authManager->guard(),
            'id'      => $this->authManager->getGuards(),
            'method'  => $method,
            'message' => "Hello {$user}.",
        ];
    }

    #[GetMapping('/test')]
    public function test(): array
    {
        return ['jdsaofijsdaoifoisadfjiosad' => 'jdfijasdiofodsajfoasdjioijo'];
    }
}
