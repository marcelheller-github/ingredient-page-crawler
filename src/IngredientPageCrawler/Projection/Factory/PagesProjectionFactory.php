<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\IngredientPageCrawler\Projection\PagesProjection;
use SocialFood\IngredientPageCrawler\Repository\PagesMysqlProjectionRepository;

class PagesProjectionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): PagesProjection
    {
        $projectionRepository = $container->get(PagesMysqlProjectionRepository::class);

        return new PagesProjection($projectionRepository);
    }
}
