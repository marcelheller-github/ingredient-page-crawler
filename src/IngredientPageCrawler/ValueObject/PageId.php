<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use Exception;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;
use SocialFood\Application\ValueObject\Uuid;

class PageId implements PrimaryKeyInterface
{
    /** @var string */
    private $pageId;

    private function __construct(string $pageId)
    {
        $this->validate($pageId);
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

    public function primaryKey(): string
    {
        return $this->pageId;
    }

    private function validate(string $pageId)
    {
        if (empty($pageId)) {
            throw new Exception(get_class($this) . ' can not be empty!');
        }

        $pageIdArray       = explode('-', $pageId);
        $invalidUuidFormat = false;

        if (strlen($pageIdArray[0]) !== 8) {
            $invalidUuidFormat = true;
        }

        if (strlen($pageIdArray[1]) !== 4) {
            $invalidUuidFormat = true;
        }

        if (strlen($pageIdArray[2]) !== 4) {
            $invalidUuidFormat = true;
        }

        if (strlen($pageIdArray[3]) !== 4) {
            $invalidUuidFormat = true;
        }

        if (strlen($pageIdArray[4]) !== 12) {
            $invalidUuidFormat = true;
        }

        if ($invalidUuidFormat) {
            throw new Exception(get_class($this) . ' can not create with invalid UUID!');
        }
    }
}
