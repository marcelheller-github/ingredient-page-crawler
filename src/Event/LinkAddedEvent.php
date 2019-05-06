<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Event;

use SocialFood\IngredientPageCrawler\Event\EventInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class LinkAddedEvent implements EventInterface
{
    /** @var Link */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function getEvent(): EventInterface
    {
        return $this;
    }
}
