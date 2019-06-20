<?php

declare(strict_types=1);

namespace SocialFood\Application\Command;

abstract class AbstractCommand implements CommandInterface
{
    public function getIdentifier(): string
    {
        $classname = substr(strrchr(get_class($this), "\\"), 1);

        return lcfirst($classname);
    }
}
