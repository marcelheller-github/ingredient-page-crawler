<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use SocialFood\IngredientPageCrawler\ValueObject\StringValueInterface;
use Traversable;

class Collection implements IteratorAggregate, Countable
{
    /** @var array | StringValueInterface[] */
    private $items = [];

    private function __construct(iterable $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public static function from(iterable $items = []): Collection
    {
        return new self($items);
    }

    public function add(StringValueInterface $item): void
    {
        $this->items[] = $item;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }
}