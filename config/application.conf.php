<?php

return [
    'settings' => [
        'displayErrorDetails'    => true,
        'addContentLengthHeader' => false,
        'db' => [
            'host'     => 'localhost',
            'user'     => 'ingredient_page_crawler',
            'password' => '1234',
            'dbname'   => 'ingredient_page_crawler',
        ]
    ],
    'bus'          => require(__DIR__ . '/bus.conf.php'),
    'dependencies' => require(__DIR__ . '/dependencies.conf.php'),
];
