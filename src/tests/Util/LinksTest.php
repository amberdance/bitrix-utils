<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Util\Links;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class LinksTest extends TestCase
{

    private static string $absoluteLink = "https://test.org";

    private static string $relativeLink = "/test/test12/";

    public function testGetTargetAttribute()
    {
        assertEquals("target='_blank'", Links::getTargetAttribute(self::$absoluteLink));
        assertEquals("target='_self'", Links::getTargetAttribute(self::$relativeLink));
    }

    public function testIsAbsolute()
    {
        assertTrue(Links::isAbsolute(self::$absoluteLink));
        assertFalse(Links::isAbsolute(self::$relativeLink));
    }

}
