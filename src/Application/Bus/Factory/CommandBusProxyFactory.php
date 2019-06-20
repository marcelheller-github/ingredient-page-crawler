<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Bus\CommandBusProxy;
use SocialFood\Application\Loader\FactoryInterface;

class CommandBusProxyFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): CommandBusProxy
    {
        return new CommandBusProxy($container);
    }
}
