<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Repository\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\Application\Wrapper\MysqlWrapper;
use SocialFood\IngredientPageCrawler\Repository\PagesMysqlProjectionRepository;

class PagesMySqlProjectionRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): PagesMysqlProjectionRepository
    {
        $mysqlWrapper = $container->get(MysqlWrapper::class);

        return new PagesMysqlProjectionRepository($mysqlWrapper);
    }
}
