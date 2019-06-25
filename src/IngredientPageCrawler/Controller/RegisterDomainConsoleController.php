<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Controller;

use SocialFood\Application\Controller\AbstractConsoleController;

class RegisterDomainConsoleController extends AbstractConsoleController
{
    public function action(array $params): void
    {
        echo 'Hello Console';

        var_dump($params);
    }
}
