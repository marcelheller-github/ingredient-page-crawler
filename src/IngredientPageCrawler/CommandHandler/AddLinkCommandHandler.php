<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\CommandHandler;

use SocialFood\Application\Bus\EventBus;
use SocialFood\Application\Command\CommandInterface;
use SocialFood\Application\CommandHandler\CommandHandlerInterface;
use SocialFood\IngredientPageCrawler\Command\AddLinkCommand;
use SocialFood\IngredientPageCrawler\Crawler\PageCrawler;
use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\Projection\LinksProjection;

class AddLinkCommandHandler implements CommandHandlerInterface
{
    /** @var EventBus */
    private $eventBus;

    /** @var LinksProjection */
    private $linkProjection;

    public function __construct(EventBus $eventBus, LinksProjection $crawledLinksProjection)
    {
        $this->eventBus       = $eventBus;
        $this->linkProjection = $crawledLinksProjection;
    }

    /**
     * @param CommandInterface|AddLinkCommand $command
     */
    public function executeCommand(CommandInterface $command): void
    {
        CMessage::text( ' >> ' .  __METHOD__);

        $link             = $command->getLink();
        $linkExist = $this->linkProjection->linkDoesExist($link);

        if ($linkExist) {
            CMessage::text('Link "' . $link->asString() . '" wurde bereits verarbeitet!');
            return;
        }

        $pageCrawler = PageCrawler::initPage($link);
        $this->eventBus->publishEvents($pageCrawler->getEventCollection());
    }
}
