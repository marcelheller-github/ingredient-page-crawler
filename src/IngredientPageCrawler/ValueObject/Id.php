<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use JsonSerializable;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;
use SocialFood\Application\ValueObject\RandomKey;

final class Id implements PrimaryKeyInterface, JsonSerializable
{
    private $id;

    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function from($id): self
    {
        return new self($id);
    }

    public static function create(): self
    {
        return new self(RandomKey::generate());
    }

    public function asString(): string
    {
        return $this->id;
    }

    public function primaryKey(): ?string
    {
        return $this->id;
    }

    public function jsonSerialize(): string
    {
        return $this->id;
    }
}
