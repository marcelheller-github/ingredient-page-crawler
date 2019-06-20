<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\CommandHandler\Factory;

use SocialFood\IngredientPageCrawler\CommandHandler\AddLinkCommandHandler;
use SocialFood\IngredientPageCrawler\EventHandler\LinkEventHandler;

class AddLinkCommandHandlerFactory
{
    public function __invoke(): AddLinkCommandHandler
    {
        $linkProjector = new LinkEventHandler();

        return new AddLinkCommandHandler();
    }
}
