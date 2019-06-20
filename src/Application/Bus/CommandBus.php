<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use Exception;
use SocialFood\Application\Command\CommandInterface;
use SocialFood\Application\CommandHandler\CommandHandlerInterface;

class CommandBus implements CommandBusInterface
{
    /** @var CommandBus */
    protected static $instance = null;

    /** @var CommandHandlerInterface[]  */
    private $commandHandler = [];

    /**
     * @return CommandBus
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function executeCommand(CommandInterface $command): void
    {
        $commandClass = get_class($command);

        if (!isset($this->commandHandler[$commandClass])) {
            throw new Exception('Es gibt keinen CommandHandler zum Command "' . $commandClass . '"');
        }

        $this->commandHandler[$commandClass]->handleCommand($command);
    }

    public function addCommandHandler(string $commandClass, CommandHandlerInterface $commandHandler): void
    {
        $this->commandHandler[$commandClass] = $commandHandler;
    }

    /**
     * @codeCoverageIgnore
     * Die Funktion kann nicht aufgerufen werden, daher kann sie nicht gecovert werden.
     */
    private function __clone()
    {
    }

    /**
     * @noinspection MagicMethodsValidityInspection
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @codeCoverageIgnore
     * Die Funktion kann nicht aufgerufen werden, daher kann sie nicht gecovert werden.
     */
    private static function __wakeup()
    {
    }
}
