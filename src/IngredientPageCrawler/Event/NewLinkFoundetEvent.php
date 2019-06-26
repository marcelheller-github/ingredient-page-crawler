<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Event;

use Exception;
use SocialFood\Application\Event\AbstractEvent;
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

    public static function fromLink(Link $link): NewLinkFoundetEvent
    {
        return new self($link);
    }

    public static function fromArray(array $data): NewLinkFoundetEvent
    {
        if (!array_key_exists('link', $data)) {
            throw new Exception(self::class . ': Key "link" does not exist.');
        }

        if (!is_string($data['link'])) {
            throw new Exception(self::class . ': "link" must be a string.');
        }

        return new self(
            Link::from($data['link'])
        );
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function toJson(): string
    {
        return json_encode([
            'link' => $this->link->asString(),
        ]);
    }
}
