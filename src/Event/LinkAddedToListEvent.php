<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Event;

use SocialFoodSolutions\ValueObject\Link;

class LinkAddedToListEvent
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
}
