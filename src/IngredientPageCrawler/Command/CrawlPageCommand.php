<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Command;

class CrawlPageCommand
{
    /** @var Page */
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getPage(): Page
    {
        return $this->page;
    }
}
