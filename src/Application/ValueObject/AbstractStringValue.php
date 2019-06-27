<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

use Exception;
use SocialFood\IngredientPageCrawler\ValueObject\Id;

abstract class AbstractStringValue implements StringInterface
{
    /** @var Id */
    protected $id;

    /** @var string */
    protected $value;

    protected function __construct(string $value, string $id = '')
    {
        $this->id = Id::create();

        if ($id !== '') {
            $this->id = $id;
        }

        $this->isValid($value);
        $this->validate($value);
        $this->value = $value;
    }

    protected function isValid(string $value): void
    {
        if ($value === '') {
            throw new Exception('AbstractStringValue can not be empty!');
        }
    }

    abstract protected function validate(string $value): void;
}
