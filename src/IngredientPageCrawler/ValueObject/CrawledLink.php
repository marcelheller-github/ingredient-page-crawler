<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use JsonSerializable;
use SocialFood\Application\ValueObject\MySqlProjectionValueInterface;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;

class CrawledLink implements MySqlProjectionValueInterface, JsonSerializable
{
    /** @var LinkId */
    private $linkId;

    /** @var Link */
    private $link;

    private function __construct(LinkId $linkId, Link $link)
    {
        $this->linkId = $linkId;
        $this->link   = $link;
    }

    public static function from(string $linkId, string $linkString): CrawledLink
    {
        return new self(
            LinkId::from($linkId),
            Link::from($linkString)
        );
    }

    public static function create(string $linkString): CrawledLink
    {
        return new self(
            LinkId::create(),
            Link::from($linkString)
        );
    }

    public static function fromDatabaseArray(array $attributes): MySqlProjectionValueInterface
    {
        return new self(
            LinkId::from($attributes['id']),
            Link::from($attributes['link'])
        );
    }

    public function getPrimaryKey(): PrimaryKeyInterface
    {
        return $this->linkId;
    }

    public function getAttributesAsMysqlParameters(): array
    {
        return [
            ':link' => $this->link->asString(),
        ];
    }

    public function getLinkId(): LinkId
    {
        return $this->linkId;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function asJsonString()
    {
        return json_encode([
            'id'   => $this->linkId->asString(),
            'link' => $this->link->asString()
        ]);
    }

    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->linkId->asString(),
            'link' => $this->link->asString()
        ];
    }
}
