<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Repository;

use SocialFood\Application\Repository\AbstractMysqlProjectionRepository;
use SocialFood\Application\Wrapper\MysqlWrapper;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class LinksMysqlProjectionRepository extends AbstractMysqlProjectionRepository
{
    public function __construct(MysqlWrapper $mysqlWrapper)
    {
        parent::__construct(
            $mysqlWrapper,
            Link::class,
            'links_projection'
        );
    }
}
