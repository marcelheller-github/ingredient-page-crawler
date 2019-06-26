<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\CommandHandler\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Bus\EventBus;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\IngredientPageCrawler\CommandHandler\AddLinkCommandHandler;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;

class AddLinkCommandHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): AddLinkCommandHandler
    {
        $eventBus        = $container->get(EventBus::class);
        $linksProjection = $container->get(LinksProjection::class);

        return new AddLinkCommandHandler($eventBus, $linksProjection);
    }
}
