<?php

declare(strict_types=1);

namespace SocialFood\Application\Bus;

use SocialFood\Application\Command\CommandInterface;
use SocialFood\Application\CommandHandler\CommandHandlerInterface;
use SocialFood\IngredientPageCrawler\Helper\CMessage;

class CommandBus implements CommandBusInterface
{
    /** @var CommandHandlerInterface[]  */
    private $commandHandler = [];

    public function executeCommand(CommandInterface $command): void
    {
        CMessage::text( ' >> ' .  __METHOD__);

        $commandClass = get_class($command);

        if (!isset($this->commandHandler[$commandClass])) {
            throw new \Exception('Es gibt keinen CommandHandler zum Command "' . $commandClass . '"');
        }

        $this->commandHandler[$commandClass]->executeCommand($command);
    }

    /**
     * @param string $commandClass
     * @param CommandHandlerInterface $commandHandler
     */
    public function addCommandHandler(string $commandClass, CommandHandlerInterface $commandHandler): void
    {
        // echo '<br>registering <b>'.$commandClass.'</b> for <b>'.get_class($commandHandler).'</b>';
        // Command Handler dürfen nur einmal registriert werden.
        if (!isset($this->commandHandler[$commandClass])) {
            $this->commandHandler[$commandClass] = $commandHandler;
        }
    }
}
