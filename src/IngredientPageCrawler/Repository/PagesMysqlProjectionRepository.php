<?php declare(strict_types=1);

namespace Synatix\ProjectDayStatistics\Repository;

use SocialFood\Application\Repository\AbstractMysqlProjectionRepository;
use SocialFood\Application\Wrapper\MysqlWrapper;
use SocialFood\IngredientPageCrawler\ValueObject\Page;

class PagesMysqlProjectionRepository extends AbstractMysqlProjectionRepository
{
    public function __construct(MysqlWrapper $mysqlWrapper)
    {
        parent::__construct(
            $mysqlWrapper,
            Page::class,
            'pages'
        );
    }
}
