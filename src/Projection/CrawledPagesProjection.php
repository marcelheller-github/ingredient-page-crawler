<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection;

use SocialFood\IngredientPageCrawler\Aggregate\PageCollection;
use SocialFood\IngredientPageCrawler\ValueObject\Page;

class CrawledPagesProjection
{
    public function add(Page $page): void
    {

    }

    public function load(): PageCollection
    {

    }
}
