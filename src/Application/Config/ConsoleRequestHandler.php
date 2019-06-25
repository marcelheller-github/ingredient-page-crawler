<?php

declare(strict_types=1);

namespace SocialFood\Application\Config;

use Exception;
use Psr\Container\ContainerInterface;
use SocialFood\Application\Controller\AbstractConsoleController;

class ConsoleRequestHandler
{
    /** @var ContainerInterface */
    private $container;

    /** @var CliArgs */
    private $cliArgs;

    /** @var array */
    private $applicationConfig;

    // https://github.com/cheprasov/php-cli-args
    private $cliArgsConfig = [
        'route' => [
            'alias'   => 'r',
            'default' => null,
            'help'    => 'Die Konsolen-Route, die aufgerufen werden soll.',
        ],
    ];

    public function __construct(ContainerInterface $container, CliArgs $cliArgs, array $applicationConfig)
    {
        $this->container         = $container;
        $this->cliArgs           = $cliArgs;
        $this->applicationConfig = $applicationConfig;

        $this->mergeCliArgsConfig();

        $this->cliArgs->setCliArgsConfig($this->cliArgsConfig);
    }

    public function handleConsoleRequest(): bool
    {
        $consoleRoute = $this->cliArgs->getArg('route');

        if ($consoleRoute === null) {
            return false;
        }

        if (!isset($this->applicationConfig['console'][$consoleRoute])) {
            throw new Exception('The console route "' . $consoleRoute . '" does not exist.');
        }

        $controllerClass = $this->applicationConfig['console'][$consoleRoute]['controller'];
        $controller      = $this->container->get($controllerClass);

        if (!$controller instanceof AbstractConsoleController) {
            $message = 'The controller "' . $controllerClass . '" must extend AbstractConsoleController.';
            throw new Exception($message);
        }

        $controllerParams = $this->getControllerParams($consoleRoute);

        $controller->action($controllerParams);

        return true;
    }

    private function mergeCliArgsConfig(): void
    {
        foreach ($this->applicationConfig['console'] as $routeConfig) {
            $routeParams = $routeConfig['params'] ?? [];
            foreach ($routeParams as $paramName => $paramConfig) {
                if (array_key_exists($paramName, $this->cliArgsConfig)) {
                    throw new Exception('The key "' . $paramName . '" already exists in the cliArgs config.');
                }
                $this->cliArgsConfig[$paramName] = $paramConfig;
            }
        }
    }

    private function getControllerParams(string $consoleRoute): array
    {
        $controllerParams   = [];
        $consoleRouteParams = $this->applicationConfig['console'][$consoleRoute]['params'] ?? [];

        foreach ($consoleRouteParams as $paramName => $paramConfig) {
            $controllerParams[$paramName] = $this->cliArgs->getArg($paramName);
        }

        return $controllerParams;
    }
}
