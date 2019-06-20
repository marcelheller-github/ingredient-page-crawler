<?php

declare(strict_types=1);

namespace SocialFood\Application\Command;

interface CommandInterface
{
    public static function fromArray(array $arrayData): AbstractCommand;
}
