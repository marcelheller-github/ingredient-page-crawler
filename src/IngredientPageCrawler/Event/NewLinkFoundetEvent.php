<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Event;

use SocialFood\Application\Event\AbstractEvent;
use SocialFood\Application\Event\EventInterface;
use SocialFood\IngredientPageCrawler\ValueObject\CrawledLink;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class NewLinkFoundetEvent extends AbstractEvent
{
    /** @var Link */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function from(string $link): NewLinkFoundetEvent
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

    public static function fromArray(array $arrayData): AbstractEvent
    {
        return new self(
            Link::from($arrayData['link'])
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
