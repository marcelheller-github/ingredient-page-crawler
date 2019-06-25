<?php

declare(strict_types=1);

namespace SocialFood\Application\Loader;

use Exception;
use Psr\Container\ContainerInterface;

class DependencyLoader
{
    /**
     * @param ContainerInterface $container
     * @throws Exception
     */
    public function loadDependencies(ContainerInterface $container): void
    {
        $dependencies = $container->get('dependencies');

        foreach ($dependencies['invokables'] as $class) {
            $container[$class] = new $class;
        }

        foreach ($dependencies['factories'] as $class => $factory) {
            $factory = new $factory;

            if (!$factory instanceof FactoryInterface) {
                throw new Exception('The factory "' . $factory . '" does not implement FactoryInterface.');
            }

            $container[$class] = ($factory)($container);
        }
    }
}
