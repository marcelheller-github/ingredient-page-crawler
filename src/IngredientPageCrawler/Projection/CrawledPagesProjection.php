<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection;

use SocialFood\IngredientPageCrawler\Aggregate\PageCollection;
use SocialFood\IngredientPageCrawler\ValueObject\PageContent;

class CrawledPagesProjection
{
    public function add(PageContent $page): void
    {

    }

    public function load(): PageCollection
    {

    }
}
