<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection;

use SocialFood\IngredientPageCrawler\Collection\Collection;
use SocialFood\IngredientPageCrawler\Repository\FileRepository;
use SocialFood\IngredientPageCrawler\Repository\ProjectionInterface;
use SocialFood\IngredientPageCrawler\Repository\RepositoryInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class CrawledLinksProjection implements ProjectionInterface
{
    /** @var RepositoryInterface */
    private $linkProjection;

    /** @var Link */
    private $link;

    private function __construct(Link $link)
    {
        $this->linkProjection = FileRepository::from($this->projectionIdentifier());
        $this->link           = $link;
    }

    public static function create(Link $link): LinkAggregate
    {
        return new self($link);
    }

    public function load(): Collection
    {
        // TODO: Implement getLinks() method.
    }

    public function hasLink(Link $link): bool
    {
        // TODO: Implement hasLink() method.
    }

    public function addLink(Link $link): void
    {
        // TODO: Implement addLink() method.
    }

    public function projectionIdentifier(): string
    {
        return substr(get_class($this), - (strlen(strrchr(get_class($this), '\\')) - 1));
    }
}
