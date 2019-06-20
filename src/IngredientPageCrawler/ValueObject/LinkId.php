<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use Exception;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;
use SocialFood\Application\ValueObject\Uuid;

class LinkId implements PrimaryKeyInterface
{
    /** @var string */
    private $linkId;

    private function __construct(string $linkId)
    {
        $this->validate($linkId);
        $this->linkId = $linkId;
    }

    public static function from(string $linkId): self
    {
        return new self($linkId);
    }

    public static function create(): self
    {
        return new self(Uuid::v4());
    }

    public function asString(): string
    {
        return $this->linkId;
    }

    public function primaryKey(): string
    {
        return $this->linkId;
    }

    private function validate(string $linkId)
    {
        if (empty($linkId)) {
            throw new Exception(get_class($this) . ' can not be empty!');
        }

        $linkIdArray = explode('-', $linkId);
        $invalidUuid = false;

        if (strlen($linkIdArray[0]) !== 8) {
            $invalidUuid = true;
        }

        if (strlen($linkIdArray[1]) !== 4) {
            $invalidUuid = true;
        }

        if (strlen($linkIdArray[2]) !== 4) {
            $invalidUuid = true;
        }

        if (strlen($linkIdArray[3]) !== 4) {
            $invalidUuid = true;
        }

        if (strlen($linkIdArray[4]) !== 12) {
            $invalidUuid = true;
        }

        if ($invalidUuid) {
            throw new Exception(get_class($this) . ' can not create with invalid UUID');
        }
    }
}
