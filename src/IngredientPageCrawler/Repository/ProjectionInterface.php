<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Repository;

use SocialFood\Application\Collection\EventCollection;

interface ProjectionInterface
{
    public static function from(string $value): ProjectionInterface;

    public function load(): EventCollection;

    public function has(string $value): bool;

    public function add(string $value): void;
}
