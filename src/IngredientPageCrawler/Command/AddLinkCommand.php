<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Command;

use Exception;
use SocialFood\Application\Command\AbstractCommand;
use SocialFood\Application\Command\CommandInterface;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

class AddLinkCommand extends AbstractCommand
{
    /** @var Link */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public static function fromArray(array $data): CommandInterface
    {
        if (array_key_exists('url', $data)) {
            return new self(Link::from($data['url']));
        }

        if (array_key_exists('domain', $data)) {
            return new self($data['domain']);
        }

        if (array_key_exists('link', $data)) {
            return new self($data['link']);
        }

        if (array_key_exists('address', $data)) {
            return new self($data['address']);
        }

        throw new Exception(self::class . ': Array Key must be (url, domain, link or address).');
    }

    public function getLink(): Link
    {
        return $this->link;
    }
}
