<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Util\Paths;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class PathsTest extends TestCase
{


    public function testIsAbsolute()
    {
        assertTrue(Paths::isAbsolute("C:\users\test.txt"));
        assertTrue(Paths::isAbsolute("https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"));
        assertFalse(Paths::isAbsolute("/some/test.txt"));
    }

    public function testGetFileName()
    {
        assertEquals("test.png", Paths::getFileName("/upload/images/test.png"));
    }

    public function testGetFileNameWitExtension()
    {
        assertEquals("test.png", Paths::getFileNameWithExtension("/upload/images/test", "png"));
    }

}
