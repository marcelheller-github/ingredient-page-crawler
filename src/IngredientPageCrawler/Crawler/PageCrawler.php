<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Crawler;

use SocialFood\Application\Collection\EventCollection;
use SocialFood\IngredientPageCrawler\Event\LinkAddedEvent;
use SocialFood\IngredientPageCrawler\Event\NewLinkFoundetEvent;
use SocialFood\IngredientPageCrawler\Event\PageCrawledEvent;
use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\ValueObject\Content;
use SocialFood\IngredientPageCrawler\ValueObject\Link;
use SocialFood\IngredientPageCrawler\ValueObject\Page;

class PageCrawler
{
    /** @var EventCollection */
    private $eventCollection;

    /** @var Page */
    private $page;

    private function __construct(Page $page)
    {
        $this->page = $page;
        $this->eventCollection = EventCollection::from([new LinkAddedEvent($page->getLink())]);
        $this->findNewLinks();
        $this->findIngredientArea();
    }

    public static function initPage(Link $link): PageCrawler
    {
        CMessage::text( ' >> ' .  __METHOD__);

        $content = Content::from(
            file_get_contents($link->asString())
        );

        return new self(Page::create($content, $link));
    }

    public function getEventCollection(): EventCollection
    {
        return $this->eventCollection;
    }

    private function findNewLinks()
    {
        $linkCrawler = new LinkCrawler($this->page->getContent());

        $links = $linkCrawler->getNewLinks();

        if ($links === null) {
            return;
        }

        foreach ($links as $link) {
            $this->eventCollection->add(NewLinkFoundetEvent::fromLink($link));
        }
    }

    private function findIngredientArea()
    {
        $ingredienCrawler = new IngredientCrawler($this->page->getContent());

        if ($ingredienCrawler->foundIngredients()) {
            $this->eventCollection->add(PageCrawledEvent::fromPage($this->page));
        }
    }
}
