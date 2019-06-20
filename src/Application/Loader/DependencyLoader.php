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

        foreach ($dependencies['invokables'] as $fqcn) {
            $container[$fqcn] = new $fqcn;
        }

        foreach ($dependencies['factories'] as $fqcn => $factoryFqcn) {
            $factory = new $factoryFqcn;

            if (!$factory instanceof FactoryInterface) {
                throw new Exception('The factory "' . $factoryFqcn . '" does not implement FactoryInterface.');
            }

            $container[$fqcn] = ($factory)($container);
        }
    }
}
