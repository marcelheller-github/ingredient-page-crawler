<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\EventHandler;

use SocialFood\Application\EventHandler\AbstractEventHandler;
use SocialFood\IngredientPageCrawler\Projection\CrawledLinksProjection;
use SocialFood\IngredientPageCrawler\ValueObject\CrawledLink;
use SocialFoodSolutions\Event\CrawledLinkAddedEvent;

class LinkEventHandler extends AbstractEventHandler
{
    /** @var CrawledLinksProjection */
    private $linksProjection;

    private function __construct(CrawledLinksProjection $linksProjection)
    {
        $this->linksProjection = $linksProjection;
    }

    public function crawledLinkAddedEventHandler(CrawledLinkAddedEvent $event)
    {
        $crawledLink = CrawledLink::create($event->getLink()->asString());
        $this->linksProjection->update($crawledLink);
    }
}
