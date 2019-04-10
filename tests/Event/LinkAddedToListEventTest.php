<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Test\Event;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\Event\LinkAddedToListEvent;
use SocialFoodSolutions\ValueObject\Link;

/**
 * @coversDefaultClass \SocialFoodSolutions\Event\LinkAddedToListEvent
 */
class LinkAddedToListEventTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getLink
     */
    public function test()
    {
        $linkStr = 'https://www.chefkoch.de/uebersicht.php';
        $link = Link::from($linkStr);
        $linkAddedToListEvent = new LinkAddedToListEvent($link);

        $this->assertEquals($linkStr, $linkAddedToListEvent->getLink()->asString());
    }
}
