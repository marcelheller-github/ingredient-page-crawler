<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Controller\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\IngredientPageCrawler\Controller\RegisterDomainConsoleController;
use SocialFood\IngredientPageCrawler\Service\LinkService;

class RegisterDomainConsoleControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container): RegisterDomainConsoleController
    {
        $linkService = $container->get(LinkService::class);

        return new RegisterDomainConsoleController($linkService);
    }
}
