<?php

declare(strict_types=1);

namespace SocialFood\Application\Event;

abstract class AbstractEvent implements EventInterface
{
    public function getIdentifier(): string
    {
        $classname = substr(strrchr(get_class($this), "\\"), 1);

        return lcfirst($classname);
    }
}
