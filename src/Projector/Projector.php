<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projector;

use SocialFood\IngredientPageCrawler\Event\EventInterface;
use SocialFood\IngredientPageCrawler\Repository\FileRepository;
use SocialFood\IngredientPageCrawler\Repository\RepositoryInterface;

class Projector
{
    /** @var RepositoryInterface[] */
    private $projections = [];

    private function __construct()
    {
        $this->projection[] = FileRepository::from($this->aggregateIdentifier());
    }

    public static function create(string $projection)
    {
        return new self($projection);
    }

    public function addProjection(string $projection)
    {
        if (!array_key_exists($projection, $this->projections)) {
            $this->projections[] = $projection;
        }
    }

    public function dispatch(EventInterface $event)
    {
        $this->projection->add()
    }
}
