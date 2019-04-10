<?php

declare(strict_types=1);

namespace SocialFoodSolutions\Test\ValueObject;

use PHPUnit\Framework\TestCase;
use SocialFoodSolutions\ValueObject\Link;

/**
 * @coversDefaultClass \SocialFoodSolutions\ValueObject\Link
 */
class LinkTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::from
     */
    public function testLinkIsInstanceOfLink()
    {
        $link = Link::from('link');
        $this->assertInstanceOf(Link::class, $link);
    }

    /**
     * @covers ::from
     * @covers ::asString
     */
    public function testCanGetLinkAsString()
    {
        $link = Link::from('link');
        $this->assertEquals('link', $link->asString());
    }
}
