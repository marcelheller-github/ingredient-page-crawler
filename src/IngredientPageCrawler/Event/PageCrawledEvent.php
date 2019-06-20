<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Event;

use SocialFood\Application\Event\AbstractEvent;
use SocialFood\Application\Event\EventInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;
use SocialFood\IngredientPageCrawler\ValueObject\Page;
use SocialFood\IngredientPageCrawler\ValueObject\PageContent;

class PageCrawledEvent extends AbstractEvent
{
    /** @var Link */
    private $link;

    /** @var PageContent */
    private $content;

    public function __construct(Link $link, PageContent $content)
    {
        $this->link    = $link;
        $this->content = $content;
    }

    public function from(string $link, string $content): PageCrawledEvent
    {
        return new self(Link::from($link), PageContent::from($content));
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function getContent(): PageContent
    {
        return $this->content;
    }

    public function getEvent(): EventInterface
    {
        return $this;
    }

    public static function fromArray(array $arrayData): AbstractEvent
    {
        return new self(
            Link::from($arrayData['link']),
            PageContent::from($arrayData['content'])
        );
    }

    public function toJson(): string
    {
        return json_encode([
            'link'    => $this->link->asString(),
            'content' => $this->content->asString()
        ]);
    }

    public static function fromObject(Page $page): AbstractEvent
    {
        return new self($page->getLink(), $page->getPageContent());
    }
}
