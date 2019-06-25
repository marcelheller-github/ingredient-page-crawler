<?php

declare(strict_types=1);

namespace SocialFood\Application\Controller;

abstract class AbstractConsoleController
{
    abstract public function action(array $params): void;
}
