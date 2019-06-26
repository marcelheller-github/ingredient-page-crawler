<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use Exception;
use SocialFood\Application\ValueObject\AbstractStringValue;

final class Content extends AbstractStringValue
{
    public static function from(string $content): Content
    {
        return new self($content);
    }

    public function asString(): string
    {
        return $this->value;
    }

    protected function validate(string $value): void
    {
//        $regex = '(?:(<html|<\!doctype html>|<\/html>|<head>|<\/head>))';
//
//        if (!preg_match($regex, $value) === 1) {
//            throw new Exception(self::class . ': must be HTML Code!');
//        }
    }
}
