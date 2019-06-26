<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Test\Event;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\Event\LinkAddedEvent;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

/**
 * @coversDefaultClass \SocialFoodSolutions\Event\LinkAddedEvent
 */
class LinkAddedToListEventTest extends TestCase
{
    public function test()
    {
        $linkStr = 'https://www.chefkoch.de/uebersicht.php';
        $link = Link::from($linkStr);
        $linkAddedToListEvent = new LinkAddedEvent($link);

        $this->assertEquals($linkStr, $linkAddedToListEvent->getEvent()->asString());
    }
}
