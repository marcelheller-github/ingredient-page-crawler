<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Test\Command;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\Command\AddLinkCommand;
use SocialFoodSolutions\ValueObject\Link;

/**
 * @coversDefaultClass \SocialFoodSolutions\Command\AddLinkCommand
 */
class AddLinkCommandTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getLink
     */
    public function testCanInitAddLinkCommandAndCreateLinkValue()
    {
        $linkStr = 'https://www.chefkoch.de/uebersicht.php';
        $command = new AddLinkCommand($linkStr);

        $this->assertInstanceOf(Link::class, $command->getLink());
        $this->assertEquals($linkStr, $command->getLink()->asString());
    }
}
