<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use SocialFood\Application\ValueObject\AbstractStringValue;

final class PageContent extends AbstractStringValue
{
    public static function from(string $pageContent): PageContent
    {
        return new self($pageContent);
    }

    public function asString(): string
    {
        return $this->value;
    }
}
