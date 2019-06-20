<?php

declare(strict_types=1);

namespace SocialFood\IngredientPageCrawler\Test\ValueObject;

use Exception;
use PHPUnit\Framework\TestCase;
use SocialFood\IngredientPageCrawler\ValueObject\Link;

/**
 * @coversDefaultClass \SocialFoodSolutions\ValueObject\LinkValue
 */
class LinkTest extends TestCase
{
    /**
     * @covers ::from
     * @covers ::asString
     */
    public function testCanGetLinkAsString()
    {
        $link = Link::from('link');
        $this->assertEquals('link', $link->asString());
    }

    /**
     * @covers ::__construct
     * @covers ::from
     */
    public function testThrowExceptionIfLinkEmpty()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Link can not be empty!');
        Link::from('');
    }
}
