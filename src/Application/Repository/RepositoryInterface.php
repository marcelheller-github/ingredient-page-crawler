<?php

declare(strict_types=1);

namespace SocialFood\Application\Repository;

use SocialFood\Application\Aggregate\AbstractAggregate;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;

interface RepositoryInterface
{
    public function saveObject(AbstractAggregate $abstractAggregate): void;

    public function readObject(PrimaryKeyInterface $id): AbstractAggregate;
    
    public function deleteObject(PrimaryKeyInterface $id): void;
}
