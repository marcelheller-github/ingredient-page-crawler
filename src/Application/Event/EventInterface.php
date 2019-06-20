<?php

declare(strict_types=1);

namespace SocialFood\Application\Event;

interface EventInterface
{
    public static function fromArray(array $arrayData): AbstractEvent;

    public function toJson(): string;
}
