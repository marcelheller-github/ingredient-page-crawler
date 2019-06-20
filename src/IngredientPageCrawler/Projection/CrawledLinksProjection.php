<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection;

use SocialFood\Application\Repository\AbstractMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\ValueObject\CrawledLink;
use SocialFood\IngredientPageCrawler\ValueObject\Link;
use Synatix\ProjectDayStatistics\Repository\PagesMysqlProjectionRepository;

class CrawledLinksProjection
{
    /** @var AbstractMysqlProjectionRepository|PagesMysqlProjectionRepository */
    private $projectionRepository;

    private function __construct(AbstractMysqlProjectionRepository $projectionRepository)
    {
        $this->projectionRepository = $projectionRepository;
    }

    public function update(CrawledLink $crawledLink): void
    {
        $this->projectionRepository->save($crawledLink);
    }

    public function remove(CrawledLink $crawledLink): void
    {
        $this->projectionRepository->delete($crawledLink);
    }

    public function getCrawledLinkByLink(Link $link): CrawledLink
    {
        $crawledLink = $this->projectionRepository->readBy([
            'link' => $link->asString()
        ]);

        return $crawledLink;
    }
}

