<?php

declare(strict_types=1);

namespace SocialFoodSolutions\ValueObject;

final class Link
{
    /** @var string */
    private $link;

    private function __construct(string $link)
    {
        $this->link = $link;
    }

    public static function from(string $link): Link
    {
        return new self($link);
    }

    public function asString(): string
    {
        return $this->link;
    }
}
