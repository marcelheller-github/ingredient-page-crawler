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
use SocialFood\IngredientPageCrawler\Controller\PostController;
use SocialFood\IngredientPageCrawler\Controller\RegisterDomainConsoleController;
use SocialFood\IngredientPageCrawler\Controller\RegisterDomainController;

return [
    'factories' => [
        //lazy loaded classes

        // extentions
        PDO::class          => PDOFactory::class,
        MysqlWrapper::class => MysqlWrapperFactory::class,

        // Repository::class => RepositoryFactory:class

        // Projection::class => ProjectionFactory::class

        // API External Systems

        // Service::class => ServiceFactory::class

        // EventHandler::class => EventHandlerFactory::class

        // Event::class
        EventBus::class => EventBusFactory::class,

        // CommandHandler::class => CommandHandlerFactory::class
        CommandBus::class => CommandBusFactory::class,

        // Controller | Controller::class => ControllerFactory::class,
    ],
    'invokables' => [
        // Invokable::class
        PhpWrapper::class,
        CurlWrapper::class,
        PostController::class,
        RegisterDomainController::class,
        RegisterDomainConsoleController::class,
    ]
];
