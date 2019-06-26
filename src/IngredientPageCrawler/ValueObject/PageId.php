<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use SocialFood\Application\ValueObject\PrimaryKeyInterface;
use SocialFood\Application\ValueObject\Uuid;

final class PageId implements PrimaryKeyInterface
{
    /** @var string */
    private $pageId;

    private function __construct(string $pageId)
    {
        $this->isValid($pageId);
        $this->pageId = $pageId;
    }

    public static function from(string $pageId): self
    {
        return new self($pageId);
    }

    public static function create(): self
    {
        return new self(Uuid::v4());
    }

    public function asString(): string
    {
        return $this->pageId;
    }

    private function isValid(string $pageId): bool
    {
        if (empty($pageId)) {
            return false;
        }

        $accountIdArray = explode('-', $pageId);

        if (strlen($accountIdArray[0]) !== 8) {
            return false;
        }

        if (strlen($accountIdArray[1]) !== 4) {
            return false;
        }

        if (strlen($accountIdArray[2]) !== 4) {
            return false;
        }

        if (strlen($accountIdArray[3]) !== 4) {
            return false;
        }

        if (strlen($accountIdArray[4]) !== 12) {
            return false;
        }

        return true;
    }

    public function primaryKey(): string
    {
        return $this->pageId;
    }
}
