<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

final class Page extends AbstractStringValue implements StringValueInterface
{
    public static function from(string $page): Page
    {
        return new self($page);
    }

    public function asString(): string
    {
        return $this->value;
    }
}
