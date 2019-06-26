<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Crawler;

use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\ValueObject\Content;

class IngredientCrawler
{
    /** @var bool */
    private $foundIngredientArea;

    /** @var Content */
    private $content;

    public function __construct(Content $content)
    {
        $this->content             = $content;
        $this->foundIngredientArea = false;
    }

    public function foundIngredients(): bool
    {
        CMessage::text( ' >> ' .  __METHOD__);

        return $this->foundIngredientArea;
    }

    private function findIngredientArea(): void
    {
        CMessage::text( ' >> ' .  __METHOD__);
    }
}
