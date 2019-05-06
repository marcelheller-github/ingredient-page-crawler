<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Command;

use SocialFood\IngredientPageCrawler\ValueObject\Link;

final class AddLinkCommand
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
