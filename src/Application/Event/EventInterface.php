<?php

declare(strict_types=1);

namespace SocialFood\Application\Event;

interface EventInterface
{
    public static function fromArray(array $data);

    public function toJson(): string;
}
