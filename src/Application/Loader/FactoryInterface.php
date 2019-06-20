<?php

declare(strict_types=1);

namespace SocialFood\Application\Loader;

use Psr\Container\ContainerInterface;

interface FactoryInterface
{
    public function __invoke(ContainerInterface $container);
}
