<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use JsonSerializable;
use SocialFood\Application\ValueObject\MySqlProjectionValueInterface;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;

class Page implements MySqlProjectionValueInterface, JsonSerializable
{
    /** @var PageId */
    private $pageId;

    /** @var PageContent */
    private $pageContent;

    /** @var Link */
    private $link;

    private function __construct(PageId $pageId, PageContent $pageContent, Link $link)
    {
        $this->pageId      = $pageId;
        $this->pageContent = $pageContent;
        $this->link        = $link;
    }

    public function from(string $pageId, string $pageContent, string $link): Page
    {
        return new self(
            PageId::from($pageId),
            PageContent::from($pageContent),
            Link::from($link),
        );
    }

    public function create(string $pageContent, string $link): Page
    {
        return new self(
            PageId::create(),
            PageContent::from($pageContent),
            Link::from($link),
        );
    }

    public static function fromDatabaseArray(array $attributes): MySqlProjectionValueInterface
    {
        return new self(
            PageId::from($attributes['id']),
            PageContent::from($attributes['content']),
            Link::from($attributes['link'])
        );
    }

    public function getPrimaryKey(): PrimaryKeyInterface
    {
        return $this->pageId;
    }

    public function getAttributesAsMysqlParameters(): array
    {
        return [
            ':content' => $this->pageContent->asString(),
            ':link'    => $this->link->asString(),
        ];
    }

    public function getPageId(): PageId
    {
        return $this->pageId;
    }

    public function getPageContent(): PageContent
    {
        return $this->pageContent;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function asJsonString()
    {
        return json_encode([
            'id'      => $this->pageId->asString(),
            'content' => $this->pageContent->asString(),
            'link'    => $this->link->asString(),
        ]);
    }

    public function jsonSerialize(): array
    {
        return [
            'id'      => $this->pageId->asString(),
            'content' => $this->pageContent->asString(),
            'link'    => $this->link->asString(),
        ];
    }
}
