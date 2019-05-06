<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\CommandHandler\Factory;

use SocialFood\IngredientPageCrawler\CommandHandler\AddLinkCommandHandler;
use SocialFood\IngredientPageCrawler\Projector\Projector;

class AddLinkCommandHandlerFactory
{
    public function __invoke(): AddLinkCommandHandler
    {
        $linkProjector = new Projector();

        return new AddLinkCommandHandler();
    }
}
