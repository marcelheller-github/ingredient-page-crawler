<?php

declare(strict_types=1);

@require(__DIR__ . '/../vendor/autoload.php');

use Slim\App;
use SocialFood\Application\Bus\CommandBus;
use SocialFood\Application\Bus\EventBus;
use SocialFood\Application\Config\CliArgs;
use SocialFood\Application\Config\ConsoleRequestHandler;
use SocialFood\Application\Loader\DependencyLoader;

define('APPLICATION_IS_PRODUCTIVE', true);
define('ROOT_PATH', __DIR__ . '/../');


$configFile = require(__DIR__ . '/../config/application.conf.php');
$app        = new App($configFile);
$container  = $app->getContainer();

$container['rootConfig']      = $configFile;
$container[EventBus::class]   = new EventBus();
$container[CommandBus::class] = new CommandBus();

### DependencyLoader ###################################################################################################

$dependencyLoader = new DependencyLoader;
$dependencyLoader->loadDependencies($container);

### ConsoleRequestHandler ##############################################################################################

$cliArgs               = new CliArgs;
$consoleRequestHandler = new ConsoleRequestHandler($container, $cliArgs, $configFile);

$isConsoleRequest = false;
if (isset($GLOBALS['argv']) && is_array($GLOBALS['argv'])) {
    $isConsoleRequest = $consoleRequestHandler->handleConsoleRequest();
}
