<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

interface StringInterface
{
    public static function from(string $value);

    public function asString(): string;
}
