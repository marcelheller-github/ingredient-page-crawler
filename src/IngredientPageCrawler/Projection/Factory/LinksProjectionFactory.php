<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;
use SocialFood\IngredientPageCrawler\Repository\LinksMysqlProjectionRepository;

class LinksProjectionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): LinksProjection
    {
        $projectionRepository = $container->get(LinksMysqlProjectionRepository::class);

        return new LinksProjection($projectionRepository);
    }
}
