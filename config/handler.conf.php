<?php

use SocialFood\Application\Bus\CommandBus;
use SocialFood\Application\Bus\EventBus;
use SocialFood\Application\Bus\Factory\CommandBusFactory;
use SocialFood\Application\Bus\Factory\EventBusFactory;

// Buses, Handler, Events
return [
    // EventHandler::class => EventHandlerFactory::class

    // Event::class
    EventBus::class => EventBusFactory::class,

    // CommandHandler::class => CommandHandlerFactory::class
    CommandBus::class => CommandBusFactory::class,
];
