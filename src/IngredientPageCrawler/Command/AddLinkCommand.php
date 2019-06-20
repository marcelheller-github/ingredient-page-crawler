<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Command;

use SocialFood\Application\Command\AbstractCommand;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class AddLinkCommand extends AbstractCommand
{
    /** @var Link */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public static function fromArray(array $arrayData): AbstractCommand
    {
        // TODO: Implement fromArray() method.
    }

    public function getLink(): Link
    {
        return $this->link;
    }
}
