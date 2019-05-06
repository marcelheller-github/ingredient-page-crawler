<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Aggregate;

use Exception;

class Aggregate
{
    /** @var string */
    private $identifier;

    private function __construct(string $identifier)
    {
        if ($identifier === '') {
            throw new Exception('Aggregate can not be empty.');
        }

        $this->identifier = $identifier;
    }

    public static function from(string $identifier): Aggregate
    {
        return new self($identifier);
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }
}
