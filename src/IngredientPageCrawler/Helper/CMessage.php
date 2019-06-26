<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Helper;

class CMessage
{
    public static function text(string $meassage): void
    {
        echo $meassage . PHP_EOL;
    }
}
