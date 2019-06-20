<?php

declare(strict_types=1);

namespace SocialFood\Application\Aggregate;

use Exception;
use SocialFood\Application\Collection\EventCollection;
use SocialFood\Application\Event\AbstractEvent;

abstract class AbstractAggregate
{
    protected $eventStoreIdentifier = '';

    protected $events = [];

    protected function __construct(?EventCollection $events)
    {
        if ($events !== null) {
            foreach ($events as $event) {
                $this->apply($event);
            }
        }
    }

    public static function from(EventCollection $events): AbstractAggregate
    {
        return new static($events);
    }

    public function record(AbstractEvent $event): void
    {
        $this->apply($event);
        $this->events[] = $event;
    }

    public function getEvents(): EventCollection
    {
        $currentEvents = EventCollection::from($this->events);

        // Damit die Events nicht mehrmals erhalten werden können, wodurch sie potentiell mehrmals auf den
        // Bus gegeben werden könnten, werden die nach dem abrufen hier aus dem Objekt entfernt.
        $this->events = [];

        return $currentEvents;
    }

    protected function apply(AbstractEvent $event)
    {
        $functionName = $event->getIdentifier() . 'Handler';

        if (!method_exists($this, $functionName)) {
            throw new Exception($functionName . ' not found in ' . get_class($this));
        }

        return $this->$functionName($event);
    }
}
