<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use SocialFood\Application\Collection\EventCollection;
use SocialFood\Application\EventHandler\AbstractEventHandler;

class EventBus implements EventBusInterface
{
    /** @var EventBus */
    protected static $instance = null;

    /** @var AbstractEventHandler[] */
    private $eventHandler = [];

    /** @return EventBus */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new EventBus();
        }

        return self::$instance;
    }

    public function publishEvents(EventCollection $events): void
    {
        foreach ($this->eventHandler as $eventHandler) {
            $eventHandler->handleEvents($events);
        }
    }

    public function addEventHandler(AbstractEventHandler $eventHandler): void
    {
        $this->eventHandler[$eventHandler->getIdentifier()] = $eventHandler;
    }
}
