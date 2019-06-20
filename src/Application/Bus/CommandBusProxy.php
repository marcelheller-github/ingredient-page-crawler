<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use Psr\Container\ContainerInterface;
use Slim\Container;
use SocialFood\Application\Command\CommandInterface;
use SocialFood\Application\CommandHandler\CommandHandlerInterface;

class CommandBusProxy implements CommandBusInterface
{
    /** @var null|CommandBus */
    protected $instance = null;

    /** @var Container */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function executeCommand(CommandInterface $command): void
    {
        $this->initInstance();
        $this->instance->executeCommand($command);
    }

    public function addCommandHandler(string $commandName, CommandHandlerInterface $commandHandler): void
    {
        $this->initInstance();
        $this->instance->addCommandHandler($commandName, $commandHandler);
    }

    private function initInstance(): void
    {
        if ($this->instance === null) {
            $this->instance = $this->container->get(CommandBus::class);
        }
    }
}
