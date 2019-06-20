<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use SocialFood\Application\Command\CommandInterface;
use SocialFood\Application\CommandHandler\CommandHandlerInterface;

interface CommandBusInterface
{
    public function executeCommand(CommandInterface $command): void;

    public function addCommandHandler(string $commandName, CommandHandlerInterface $commandHandler): void;
}
