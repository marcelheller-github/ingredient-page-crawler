<?php

declare(strict_types=1);

@require(__DIR__ . '/../vendor/autoload.php');

use Slim\App;

define('ROOT_PATH', __DIR__ . '/../');

$appConfig = require(__DIR__ . '/../config/application.conf.php');
$app        = new App($appConfig);
$container  = $app->getContainer();

$app->run();
