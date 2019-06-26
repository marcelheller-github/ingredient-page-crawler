<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Bus\CommandBus;
use SocialFood\Application\Loader\FactoryInterface;

class CommandBusFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): CommandBus
    {
        $config           = $container->get('bus');
        $commandBusConfig = $config['commandBus'];
        $commandBus       = $container->get(CommandBus::class);

        foreach ($commandBusConfig as $command => $handler) {
            $handlerInstance   = $container->get($handler);
            $commandBus->addCommandHandler($command, $handlerInstance);
        }

        return $commandBus;
    }
}
