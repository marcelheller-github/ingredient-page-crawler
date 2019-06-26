<?php

declare(strict_types=1);

namespace SocialFood\Application\CommandHandler;

use SocialFood\Application\Command\CommandInterface;

interface CommandHandlerInterface
{
    public function executeCommand(CommandInterface $command): void;
}
