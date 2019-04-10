<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Command;

use SocialFoodSolutions\ValueObject\Link;

class AddLinkCommand
{
    /** @var Link */
    private $link;

    public function __construct(string $link)
    {
        $this->link = Link::from($link);
    }

    public function getLink(): Link
    {
        return $this->link;
    }
}
