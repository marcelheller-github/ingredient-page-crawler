<?php

declare(strict_types=1);

namespace SocialFood\Application\Repository;

use SocialFood\Application\Aggregate\AbstractAggregate;
use SocialFood\Application\ValueObject\ForeignKeyInterface;

interface RelationRepositoryInterface
{
    public function readRelationByForeignKey(ForeignKeyInterface $foreignKeyId): AbstractAggregate;
}
