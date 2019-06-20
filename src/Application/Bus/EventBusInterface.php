<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use SocialFood\Application\Collection\EventCollection;

interface EventBusInterface
{
    public function publishEvents(EventCollection $events): void;
}
