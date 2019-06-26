<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\ValueObject;

use Exception;
use SocialFood\Application\ValueObject\AbstractStringValue;
use SocialFood\Application\ValueObject\MySqlProjectionValueInterface;
use SocialFood\Application\ValueObject\PrimaryKeyInterface;

final class Link extends AbstractStringValue implements PrimaryKeyInterface, MySqlProjectionValueInterface
{
    public static function from(string $link): Link
    {
        return new self($link);
    }

    public static function fromArray(array $data): Link
    {
        if (array_key_exists('link', $data)) {
            return new self($data['link']);
        }

        throw new Exception(self::class . ': can only create with Array Key "link").');
    }

    protected function validate(string $value): void
    {
        $regex = '/(?:(https:\/\/|http:\/\/|www.|ftp:\/\/|ftps:\/\/))' .
            '(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9].+/';

        if (!preg_match($regex, $value) === 1) {
            throw new Exception(self::class . ': must be a readable complete URL or Domain!');
        }
    }

    public function asString(): string
    {
        return $this->value;
    }

    public function primaryKey(): ?string
    {
        return null;
    }

    public static function fromDatabaseArray(array $data): MySqlProjectionValueInterface
    {
        return new self(
            $data['link']
        );
    }

    public function getPrimaryKey(): PrimaryKeyInterface
    {
        return $this;
    }

    public function getAttributesAsMysqlParameters(): array
    {
        return [
            ':link' => $this->value
        ];
    }
}
