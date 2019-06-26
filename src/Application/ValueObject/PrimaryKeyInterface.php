<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

interface PrimaryKeyInterface
{
    public function primaryKey(): ?string;
}
