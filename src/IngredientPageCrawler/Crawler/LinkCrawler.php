<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Crawler;

use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\ValueObject\Content;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class LinkCrawler
{
    /** @var Link[] */
    private $newLinks;

    /** @var Content */
    private $content;

    public function __construct(Content $content)
    {
        $this->content  = $content;
        $this->newLinks = [];
    }

    /** @return Link[] */
    public function getNewLinks(): array
    {
        CMessage::text( ' >> ' .  __METHOD__);

        return $this->newLinks;
    }
}
