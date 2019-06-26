<?php

use SocialFood\IngredientPageCrawler\Controller\PostController;
use SocialFood\IngredientPageCrawler\Controller\RegisterDomainConsoleController;

return [
    'settings' => [
        'displayErrorDetails'    => true,
        'addContentLengthHeader' => false,
        'db' => [
            'host'     => 'localhost',
            'user'     => 'testing',
            'password' => 'jv4i7uRBakq3LTql',
            'dbname'   => 'testing_ingredient_page_crawler',
        ]
    ],
    'bus'           => require(__DIR__ . '/bus.conf.php'),
    'dependencies'  => require(__DIR__ . '/dependencies.conf.php'),
    'console' => [
        'registerDomnain' => [
            'controller' => RegisterDomainConsoleController::class,
            'params'     => [
                'domain' => [
                    'default' => '',
                    'alias' => 'd'
                ]
            ],
        ],
    ]
];
