<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Service\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Bus\CommandBus;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;
use SocialFood\IngredientPageCrawler\Service\LinkService;

class LinkServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): LinkService
    {
        $commandBus     = $container->get(CommandBus::class);
        $linkProjection = $container->get(LinksProjection::class);

        return new LinkService($commandBus, $linkProjection);
    }
}
