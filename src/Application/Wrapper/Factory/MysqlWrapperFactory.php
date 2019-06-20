<?php

declare(strict_types=1);

namespace SocialFood\Application\Wrapper\Factory;

use PDO;
use Psr\Container\ContainerInterface;
use SocialFood\Application\Loader\FactoryInterface;
use SocialFood\Application\Wrapper\MysqlWrapper;

class MysqlWrapperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): MysqlWrapper
    {
        $pdo = $container->get(PDO::class);

        return new MysqlWrapper($pdo);
    }
}
