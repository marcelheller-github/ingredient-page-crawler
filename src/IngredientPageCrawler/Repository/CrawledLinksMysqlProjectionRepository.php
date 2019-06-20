<?php declare(strict_types=1);

namespace Synatix\ProjectDayStatistics\Repository;

use SocialFood\Application\Repository\AbstractMysqlProjectionRepository;
use SocialFood\Application\Wrapper\MysqlWrapper;
use SocialFood\IngredientPageCrawler\ValueObject\CrawledLink;

class CrawledLinksMysqlProjectionRepository extends AbstractMysqlProjectionRepository
{
    public function __construct(MysqlWrapper $mysqlWrapper)
    {
        parent::__construct(
            $mysqlWrapper,
            CrawledLink::class,
            'crawled_links'
        );
    }
}
