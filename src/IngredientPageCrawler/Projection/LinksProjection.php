<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection;

use SocialFood\Application\Repository\AbstractMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\Helper\CMessage;
use SocialFood\IngredientPageCrawler\Repository\LinksMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class LinksProjection
{
    /** @var AbstractMysqlProjectionRepository|LinksMysqlProjectionRepository */
    private $projectionRepository;

    public function __construct(AbstractMysqlProjectionRepository $projectionRepository)
    {
        $this->projectionRepository = $projectionRepository;
    }

    public function update(Link $link): void
    {
        $this->projectionRepository->save($link);
        CMessage::text( ' >> ' .  __METHOD__);
    }

    public function remove(Link $link): void
    {
        $this->projectionRepository->delete($link);
    }

    public function linkDoesExist(Link $link): bool
    {
        CMessage::text( ' >> ' .  __METHOD__);

        $link = $this->projectionRepository->readOneBy([
            'link' => $link->asString(),
        ]);

        if ($link !== null) {
            return true;
        }

        return false;
    }
}

