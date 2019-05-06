<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Aggregate;

use SocialFood\IngredientPageCrawler\Collection\Collection;

interface AggregateInterface
{
    public function aggregateIdentifier(): string;
}
