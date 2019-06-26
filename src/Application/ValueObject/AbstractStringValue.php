<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

use Exception;

abstract class AbstractStringValue implements StringInterface
{
    /** @var string */
    protected $value;

    protected function __construct(string $value)
    {
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
