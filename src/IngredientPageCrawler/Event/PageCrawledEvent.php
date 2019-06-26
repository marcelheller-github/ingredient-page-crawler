<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Event;

use Exception;
use SocialFood\Application\Event\AbstractEvent;
use SocialFood\Application\Event\EventInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;
use SocialFood\IngredientPageCrawler\ValueObject\Page;
use SocialFood\IngredientPageCrawler\ValueObject\Content;
use SocialFood\IngredientPageCrawler\ValueObject\PageId;

class PageCrawledEvent extends AbstractEvent
{
    /** @var PageId */
    private $pageId;

    /** @var Link */
    private $link;

    /** @var Content */
    private $content;

    public function __construct(PageId $pageId, Link $link, Content $content)
    {
        $this->pageId  = $pageId;
        $this->link    = $link;
        $this->content = $content;
    }

    public function from(string $pageId, string $link, string $content): PageCrawledEvent
    {
        return new self(
            PageId::from($pageId),
            Link::from($link),
            Content::from($content)
        );
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getEvent(): EventInterface
    {
        return $this;
    }

    public static function fromArray(array $data): PageCrawledEvent
    {
        if (!array_key_exists('id', $data)) {
            throw new Exception(self::class . ': Key "id" does not exist.');
        }

        if (!array_key_exists('link', $data)) {
            throw new Exception(self::class . ': Key "link" does not exist.');
        }

        if (!array_key_exists('content', $data)) {
            throw new Exception(self::class . ': Key "content" does not exist.');
        }

        if (!is_string($data['id'])) {
            throw new Exception(self::class . ': "id" must be a string.');
        }

        if (!is_string($data['link'])) {
            throw new Exception(self::class . ': "link" must be a string.');
        }

        if (!is_string($data['content'])) {
            throw new Exception(self::class . ': "content" must be a string.');
        }

        return new self(
            PageId::from($data['id']),
            Link::from($data['link']),
            Content::from($data['content'])
        );
    }

    public function toJson(): string
    {
        return json_encode([
            'id'      => $this->pageId->asString(),
            'link'    => $this->link->asString(),
            'content' => $this->content->asString()
        ]);
    }

    public static function fromPage(Page $page): PageCrawledEvent
    {
        if (!($page instanceof Page)) {
            throw new Exception(self::class . ': wrong Object, should Page::class');
        }

        return new self($page->getPageId(), $page->getLink(), $page->getContent());
    }
}
