<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\CommandHandler;

use SocialFood\IngredientPageCrawler\Aggregate\LinkAggregate;
use SocialFood\IngredientPageCrawler\Command\AddLinkCommand;
use SocialFood\IngredientPageCrawler\Projection\CrawledLinksProjection;

class AddLinkCommandHandler
{
    /** @var CrawledLinksProjection */
    private $linkProjection;

    public function __construct(CrawledLinksProjection $crawledLinksProjection)
    {
        $this->linkProjection = $crawledLinksProjection;
    }

    public function executeCommand(AddLinkCommand $command): void
    {
        $linkExists    = $this->linkProjection->hasLink($command->getLink());
        $linkAggregate = LinkAggregate::create($command->getLink());

        if ($linkExists === false) {
            $linkAggregate->createEvent();

            if ()
        }

    }
}
