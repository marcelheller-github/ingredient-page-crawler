<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Projection;

use SocialFood\Application\Repository\AbstractMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\Repository\PagesMysqlProjectionRepository;
use SocialFood\IngredientPageCrawler\ValueObject\Page;

class PagesProjection
{
    /** @var AbstractMysqlProjectionRepository|PagesMysqlProjectionRepository */
    private $projectionRepository;

    public function __construct(AbstractMysqlProjectionRepository $projectionRepository)
    {
        $this->projectionRepository = $projectionRepository;
    }

    public function save(Page $page): void
    {
        $this->projectionRepository->save($page);
    }
}
