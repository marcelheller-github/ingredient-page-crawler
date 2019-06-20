<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Test\Event;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\Event\CrawledLinkAddedEvent;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

/**
 * @coversDefaultClass \SocialFoodSolutions\Event\CrawledLinkAddedEvent
 */
class LinkAddedToListEventTest extends TestCase
{
    public function test()
    {
        $linkStr = 'https://www.chefkoch.de/uebersicht.php';
        $link = Link::from($linkStr);
        $linkAddedToListEvent = new CrawledLinkAddedEvent($link);

        $this->assertEquals($linkStr, $linkAddedToListEvent->getEvent()->asString());
    }
}
