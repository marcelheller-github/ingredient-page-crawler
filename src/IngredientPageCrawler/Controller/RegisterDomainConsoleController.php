<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Controller;

use SocialFood\Application\Controller\AbstractConsoleController;
use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\Service\LinkService;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class RegisterDomainConsoleController extends AbstractConsoleController
{
    /** @var LinkService */
    private $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function action(array $params): void
    {
        CMessage::text('### INGREDIENT PAGE CRAWLER ###');

        $link = Link::from($params['domain']);
        $this->linkService->createAddLinkCommand($link);
    }
}
