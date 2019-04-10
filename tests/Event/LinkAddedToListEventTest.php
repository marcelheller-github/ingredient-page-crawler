<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Test\Event;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\Event\LinkAddedToListEvent;
use SocialFoodSolutions\ValueObject\Link;

class LinkAddedToListEventTest extends TestCase
{
    public function test()
    {
        $linkStr = 'https://www.chefkoch.de/uebersicht.php';
        $link = Link::from($linkStr);
        $linkAddedToListEvent = new LinkAddedToListEvent($link);

        $this->assertEquals($linkStr, $linkAddedToListEvent->getLink()->asString());
    }
}
