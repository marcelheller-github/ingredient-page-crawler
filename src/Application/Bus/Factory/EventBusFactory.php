<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus\Factory;

use Psr\Container\ContainerInterface;
use SocialFood\Application\Bus\EventBus;
use SocialFood\Application\Loader\FactoryInterface;

class EventBusFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container): EventBus
    {
        $config           = $container->get('bus');
        $eventBusConfig   = $config['eventBus'];
        $eventBus         = EventBus::getInstance();

        foreach ($eventBusConfig as $handler) {
            $handlerInstance   = $container->get($handler);
            $eventBus->addEventHandler($handlerInstance);
        }

        return $eventBus;
    }
}
