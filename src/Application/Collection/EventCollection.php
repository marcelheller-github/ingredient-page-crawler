<?php

declare(strict_types=1);

namespace SocialFood\Application\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use SocialFood\Application\Event\AbstractEvent;

class EventCollection implements IteratorAggregate, Countable
{
    private $events = [];

    private function __construct(iterable $events)
    {
        foreach ($events as $event) {
            $this->add($event);
        }
    }

    public static function from(iterable $events = []): EventCollection
    {
        return new self($events);
    }

    public function add(AbstractEvent $event): void
    {
        $this->events[] = $event;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->events);
    }

    public function count(): int
    {
        return count($this->events);
    }
}
