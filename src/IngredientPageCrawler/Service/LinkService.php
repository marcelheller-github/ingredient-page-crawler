<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Service;

use SocialFood\Application\Bus\CommandBus;
use SocialFood\IngredientPageCrawler\Command\AddLinkCommand;
use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class LinkService
{
    /** @var CommandBus */
    private $commandBus;

    /** @var LinksProjection */
    private $linksProjection;

    public function __construct(CommandBus $commandBus, LinksProjection $linksProjection)
    {
        $this->commandBus      = $commandBus;
        $this->linksProjection = $linksProjection;
    }

    public function createAddLinkCommand(Link $link): void
    {
        CMessage::text( ' >> ' .  __METHOD__);

        $addLinkCommand = new AddLinkCommand($link);

        $this->commandBus->executeCommand($addLinkCommand);
    }
}
