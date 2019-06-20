<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

interface ForeignKeyInterface
{
    public function foreignKey(): string;
}
