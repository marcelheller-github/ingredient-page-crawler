<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Event;

use SocialFood\Application\Event\AbstractEvent;
use SocialFood\Application\Event\EventInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class LinkAddedEvent extends AbstractEvent
{
    /** @var Link */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function from(string $link): LinkAddedEvent
    {
        return new self(Link::from($link));
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function getEvent(): EventInterface
    {
        return $this;
    }

    public static function fromArray(array $data): AbstractEvent
    {
        return new self(
            Link::from($data['link'])
        );
    }

    public function toJson(): string
    {
        return json_encode([
            'link' => $this->link,
        ]);
    }

    public static function fromObject(CrawledLink $crawledLink): AbstractEvent
    {
        return new self($crawledLink->getLink());
    }
}
