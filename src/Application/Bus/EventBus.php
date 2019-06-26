<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use SocialFood\Application\Collection\EventCollection;
use SocialFood\Application\EventHandler\AbstractEventHandler;

class EventBus implements EventBusInterface
{
    /** @var AbstractEventHandler[] */
    private $eventHandler = [];

    public function publishEvents(EventCollection $events): void
    {
        foreach ($this->eventHandler as $eventHandler) {
            $eventHandler->handleEvents($events);
        }
    }

    public function addEventHandler(AbstractEventHandler $eventHandler): void
    {
        $identifier = $eventHandler->getIdentifier();

        // EventHandler dürfen nur einmal registriert werden.
        if (!isset($this->eventHandler[$identifier])) {
            $this->eventHandler[$identifier] = $eventHandler;
        }
    }
}
