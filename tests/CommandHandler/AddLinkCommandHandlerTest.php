<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Test\CommandHandler;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\CommandHandler\AddLinkCommandHandler;

class AddLinkCommandHandlerTest extends TestCase
{
    public function testCanHandleAddLinkCommand()
    {
        $commandHandler = new AddLinkCommandHandler();

        $this->assertInstanceOf(AddLinkCommandHandler::class, $commandHandler);
    }
}

