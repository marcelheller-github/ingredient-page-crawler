<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Repository;

use SocialFood\IngredientPageCrawler\Collection\Collection;

class FileRepository implements RepositoryInterface
{
    private const DATA_PATH = __DIR__ . '../../data/';

    /** @var string */
    private $filename;

    /** @var Collection */
    private $data = [];

    /** @var bool|null */
    private $found = null;

    private function __construct(string $value)
    {
        $this->filename = self::DATA_PATH . $value . 's.json';
        $this->initData();
    }

    public static function from(string $value): RepositoryInterface
    {
        return new self($value);
    }

    public function load(): Collection
    {
        return Collection::from($this->data);
    }

    public function has(string $value): bool
    {
        $this->initFound($value);

        return $this->found;
    }

    public function add(string $value): void
    {
        $this->initFound($value);

        if ($this->found === false) {
            $this->data->add($value);

            unlink($this->filename);
            file_put_contents($this->filename, json_encode($this->data, JSON_FORCE_OBJECT));
        }

        echo 'Link:' . $value . ' exists.' . PHP_EOL;
    }

    private function initData(): void
    {
        if (!file_exists($this->filename)) {
            file_put_contents($this->filename, json_encode($this->data, JSON_FORCE_OBJECT));
        }

        $jsonData = file_get_contents($this->filename);

        $this->data = json_decode($jsonData, true);
    }

    private function initFound(string $value): void
    {
        $this->found = false;

        foreach ($this->data as $item) {
            if ($item === $value) {
                $this->found = true;
            }
        }
    }
}
