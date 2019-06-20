<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Test\Command;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\Command\AddLinkCommand;
use SocialFoodSolutions\ValueObject\LinkValue;

/**
 * @coversDefaultClass \SocialFoodSolutions\Command\AddLinkCommand
 */
class AddLinkCommandTest extends TestCase
{
    public function testCanInitAddLinkCommandAndCreateLinkValue()
    {
        $linkStr = 'https://www.chefkoch.de/uebersicht.php';
        $command = new AddLinkCommand($linkStr);

        $this->assertInstanceOf(LinkValue::class, $command->getLink());
        $this->assertEquals($linkStr, $command->getLink()->asString());
    }
}
