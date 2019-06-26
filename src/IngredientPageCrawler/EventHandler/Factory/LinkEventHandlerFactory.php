<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\EventHandler\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\IngredientPageCrawler\EventHandler\LinkEventHandler;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;
use SocialFood\IngredientPageCrawler\Service\LinkService;

class LinkEventHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): LinkEventHandler
    {
        $linksProjection = $container->get(LinksProjection::class);
        $linkService     = $container->get(LinkService::class);

        return new LinkEventHandler($linksProjection, $linkService);
    }
}
