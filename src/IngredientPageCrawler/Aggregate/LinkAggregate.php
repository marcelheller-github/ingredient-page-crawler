<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Aggregate;

use SocialFood\Application\Aggregate\AbstractAggregate;
use SocialFood\IngredientPageCrawler\Repository\FileRepository;
use SocialFood\IngredientPageCrawler\Repository\ProjectionInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;
use SocialFoodSolutions\Event\CrawledLinkAddedEvent;

class LinkAggregate extends AbstractAggregate
{
    /** @var ProjectionInterface */
    private $linkRepository;

    /** @var Link */
    private $link;

    private function __construct(Link $link)
    {
        $this->linkRepository = FileRepository::from($this->aggregateIdentifier());
        $this->link           = $link;
    }

    public static function create(Link $link): LinkAggregate
    {
        return new self($link);
    }

    public function aggregateIdentifier(): string
    {
        return substr(get_class($this), - (strlen(strrchr(get_class($this), '\\')) - 1));
    }

    public function createEvent(): EventInterface
    {
        $this->linkRepository->add($this->link->asString());

        return new CrawledLinkAddedEvent($this->link);
    }
}
