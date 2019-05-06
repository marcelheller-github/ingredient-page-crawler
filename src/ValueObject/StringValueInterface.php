<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

interface StringValueInterface
{
    public static function from(string $value);

    public function asString(): string;
}
