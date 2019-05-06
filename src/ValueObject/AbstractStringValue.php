<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use RuntimeException;

abstract class AbstractStringValue
{
    /** @var string */
    protected $value;

    protected function __construct(string $value)
    {
        if ($value === null) {
            throw new RuntimeException('Value can not be null or empty');
        }

        $this->value = $value;
    }
}
