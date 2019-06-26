<?php

use SocialFood\IngredientPageCrawler\Command\AddLinkCommand;
use SocialFood\IngredientPageCrawler\CommandHandler\AddLinkCommandHandler;
use SocialFood\IngredientPageCrawler\EventHandler\LinkEventHandler;

return [
    'eventBus' => [
        // EventHandler::class | Policy::class
        LinkEventHandler::class,
    ],
    'commandBus' => [
        // Command::class => CommandHandler::class
        AddLinkCommand::class => AddLinkCommandHandler::class,
    ]
];
