<?php

declare(strict_types=1);

namespace SocialFood\Application\ValueObject;

interface MySqlProjectionValueInterface
{
    public static function fromDatabaseArray(array $attributes): self;

    public function getPrimaryKey(): PrimaryKeyInterface;

    public function getAttributesAsMysqlParameters(): array;
}
