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

    /** @var Content */
    private $content;

    /** @var Link */
    private $link;

    private function __construct(PageId $pageId, Content $content, Link $link)
    {
        $this->pageId  = $pageId;
        $this->content = $content;
        $this->link    = $link;
    }

    public static function from(string $pageId, string $content, string $link): Page
    {
        return new self(
            PageId::from($pageId),
            Content::from($content),
            Link::from($link),
        );
    }

    public static function create(Content $content, Link $link): Page
    {
        return new self(
            PageId::create(),
            $content,
            $link
        );
    }

    public static function fromDatabaseArray(array $data): MySqlProjectionValueInterface
    {
        return new self(
            PageId::from($data['id']),
            Content::from($data['content']),
            Link::from($data['link'])
        );
    }

    public function getPrimaryKey(): PrimaryKeyInterface
    {
        return $this->pageId;
    }

    public function getAttributesAsMysqlParameters(): array
    {
        return [
            ':content' => $this->content->asString(),
            ':link'    => $this->link->asString(),
        ];
    }

    public function getPageId(): PageId
    {
        return $this->pageId;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function asJsonString()
    {
        return json_encode([
            'id'      => $this->pageId->asString(),
            'content' => $this->content->asString(),
            'link'    => $this->link->asString(),
        ]);
    }

    public function jsonSerialize(): array
    {
        return [
            'id'      => $this->pageId->asString(),
            'content' => $this->content->asString(),
            'link'    => $this->link->asString(),
        ];
    }
}
