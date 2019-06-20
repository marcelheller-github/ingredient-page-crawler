<?php

declare(strict_types=1);

namespace SocialFood\Application\EventHandler;

use SocialFood\Application\Collection\EventCollection;
use SocialFood\Application\Event\AbstractEvent;

abstract class AbstractEventHandler
{
    public function handleEvents(EventCollection $eventCollection)
    {
        /** @var AbstractEvent $event */
        foreach ($eventCollection as $event) {
            $functionName = $event->getIdentifier() . 'Handler';

            if (!method_exists($this, $functionName)) {
                continue;
            }

            $this->$functionName($event);
        }
    }

    public function getIdentifier(): string
    {
        $className = substr(strrchr(get_class($this), "\\"), 1);

        return lcfirst($className);
    }
}
