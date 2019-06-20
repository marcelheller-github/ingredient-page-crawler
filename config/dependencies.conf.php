<?php

return [
    'factories' => [
        //lazy loaded classes
        require(__DIR__ . '/lazyloaded.conf.php'),

        // extentions
        require(__DIR__ . '/extentions.conf.php'),

        // Repositories
        require(__DIR__ . '/repository.conf.php'),

        // Projections
        require(__DIR__ . '/projections.conf.php'),

        // API External Systems

        // Services
        require(__DIR__ . '/services.conf.php'),

        // EventHandler | Events | CommandHandler
        require(__DIR__ . '/handler.conf.php'),

        // Controller
        require(__DIR__ . '/controller.conf.php'),
    ],
    'invokables' => require(__DIR__ . '/invokables.conf.php')
];
