<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

final class RandomKey
{
    public static function generate(): string
    {
        return sprintf(
            '%04x%04x%04x%04x%04x%04x',
            random_int(0, 0x3fff) | 0x8000,
            random_int(0, 0x8fff),
            random_int(0, 0x3fff) | 0x0000,
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff)
        );
    }
}
