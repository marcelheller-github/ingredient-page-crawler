<?php

use SocialFood\Application\Bus\CommandBus;
use SocialFood\Application\Bus\EventBus;
use SocialFood\Application\Bus\Factory\CommandBusFactory;
use SocialFood\Application\Bus\Factory\EventBusFactory;
use SocialFood\Application\Repository\Factory\PDOFactory;
use SocialFood\Application\Wrapper\CurlWrapper;
use SocialFood\Application\Wrapper\Factory\MysqlWrapperFactory;
use SocialFood\Application\Wrapper\MysqlWrapper;
use SocialFood\Application\Wrapper\PhpWrapper;
use SocialFood\IngredientPageCrawler\CommandHandler\AddLinkCommandHandler;
use SocialFood\IngredientPageCrawler\CommandHandler\Factory\AddLinkCommandHandlerFactory;
use SocialFood\IngredientPageCrawler\Controller\Factory\RegisterDomainConsoleControllerFactory;
use SocialFood\IngredientPageCrawler\Controller\RegisterDomainConsoleController;
use SocialFood\IngredientPageCrawler\EventHandler\Factory\LinkEventHandlerFactory;
use SocialFood\IngredientPageCrawler\EventHandler\LinkEventHandler;
use SocialFood\IngredientPageCrawler\Projection\Factory\LinksProjectionFactory;
use SocialFood\IngredientPageCrawler\Projection\Factory\PagesProjectionFactory;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;
use SocialFood\IngredientPageCrawler\Projection\PagesProjection;
use SocialFood\IngredientPageCrawler\Repository\Factory\LinksMySqlProjectionRepositoryFactory;
use SocialFood\IngredientPageCrawler\Repository\Factory\PagesMySqlProjectionRepositoryFactory;
use SocialFood\IngredientPageCrawler\Repository\LinksMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\Repository\PagesMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\Service\Factory\LinkServiceFactory;
use SocialFood\IngredientPageCrawler\Service\LinkService;

return [
    'factories' => [
        //lazy loaded classes

        // extentions
        PDO::class          => PDOFactory::class,
        MysqlWrapper::class => MysqlWrapperFactory::class,

        // Repository::class => RepositoryFactory:class
        LinksMysqlProjectionRepository::class => LinksMySqlProjectionRepositoryFactory::class,
        PagesMysqlProjectionRepository::class => PagesMySqlProjectionRepositoryFactory::class,

        // Projection::class => ProjectionFactory::class
        LinksProjection::class => LinksProjectionFactory::class,
        PagesProjection::class => PagesProjectionFactory::class,

        // API External Systems

        // Service::class => ServiceFactory::class
        LinkService::class => LinkServiceFactory::class,

        // EventHandler::class => EventHandlerFactory::class
        LinkEventHandler::class => LinkEventHandlerFactory::class,

        // Event::class
        EventBus::class => EventBusFactory::class,

        // CommandHandler::class => CommandHandlerFactory::class
        AddLinkCommandHandler::class => AddLinkCommandHandlerFactory::class,
        CommandBus::class            => CommandBusFactory::class,

        // Controller | Controller::class => ControllerFactory::class,
        RegisterDomainConsoleController::class => RegisterDomainConsoleControllerFactory::class,
    ],
    'invokables' => [
        // Invokable::class
        PhpWrapper::class,
        CurlWrapper::class,
    ]
];
