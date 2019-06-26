<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Repository\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\Application\Wrapper\MysqlWrapper;
use SocialFood\IngredientPageCrawler\Repository\LinksMysqlProjectionRepository;

class LinksMySqlProjectionRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): LinksMysqlProjectionRepository
    {
        $mysqlWrapper = $container->get(MysqlWrapper::class);

        return new LinksMysqlProjectionRepository($mysqlWrapper);
    }
}
