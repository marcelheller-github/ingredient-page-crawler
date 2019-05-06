<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Repository;

use SocialFood\IngredientPageCrawler\Collection\Collection;

interface RepositoryInterface
{
    public static function from(string $value): RepositoryInterface;

    public function load(): Collection;

    public function has(string $value): bool;

    public function add(string $value): void;
}
