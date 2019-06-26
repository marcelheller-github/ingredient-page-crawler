<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\EventHandler;

use SocialFood\Application\EventHandler\AbstractEventHandler;
use SocialFood\IngredientPageCrawler\Event\LinkAddedEvent;
use SocialFood\IngredientPageCrawler\Event\NewLinkFoundetEvent;
use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;
use SocialFood\IngredientPageCrawler\Service\LinkService;

class LinkEventHandler extends AbstractEventHandler
{
    /** @var LinksProjection */
    private $linksProjection;

    /** @var LinkService */
    private $linkService;

    public function __construct(LinksProjection $linksProjection, LinkService $linkService)
    {
        $this->linksProjection = $linksProjection;
        $this->linkService = $linkService;
    }

    public function linkAddedEventHandler(LinkAddedEvent $event)
    {
        CMessage::text('Link added: ' . $event->getLink()->asString());
        $this->linksProjection->update($event->getLink());
    }

    public function newLinkFoundetEventHandler(NewLinkFoundetEvent $event)
    {
        CMessage::text('New Link: ' . $event->getLink()->asString());
        $this->linkService->createAddLinkCommand($event->getLink());
    }
}
