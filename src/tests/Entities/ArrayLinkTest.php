<?php

namespace Hard2Code\Tests\Entities;


use Hard2Code\Entity\Link\ArrayLink;
use Hard2Code\Entity\Link\ArrayLinkImpl;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class ArrayLinkTest extends EntityTestBase
{

    private static array $TEST_DATA;
    private static ArrayLink $ARRAY_LINK;

    public function testGetTitle()
    {
        assertEquals(self::$TEST_DATA["TEXT"], self::$ARRAY_LINK->getTitle());
    }

    public function testGetSource()
    {
        assertEquals(self::$TEST_DATA["LINK"], self::$ARRAY_LINK->getSource());
        assertEquals(self::$TEST_DATA["LINK"], self::$ARRAY_LINK->getLink());
    }

    public function testIsSelected()
    {
        assertEquals(self::$TEST_DATA["SELECTED"], self::$ARRAY_LINK->isSelected());
    }

    public function testGetPermission()
    {
        assertEquals(self::$TEST_DATA["PERMISSION"], self::$ARRAY_LINK->getPermission());
    }

    public function testGetParams()
    {
        assertEquals(self::$TEST_DATA["PARAMS"], self::$ARRAY_LINK->getParams());
    }

    public function testGetIsParent()
    {
        assertEquals(self::$TEST_DATA["IS_PARENT"], self::$ARRAY_LINK->isParent());
    }

    public function testGetDepthLevel()
    {
        assertEquals(self::$TEST_DATA["DEPTH_LEVEL"], self::$ARRAY_LINK->getDepthLevel());
    }


    public function testGetIndex()
    {
        assertEquals(self::$TEST_DATA["INDEX"], self::$ARRAY_LINK->getIndex());
    }


    public function testIsAbsolute()
    {
        assertFalse(self::$ARRAY_LINK->isAbsolute());
    }

    public function testIsRelative()
    {
        assertTrue(self::$ARRAY_LINK->isRelative());
    }

    protected function setUp(): void
    {
        self::$TEST_DATA = $this->includeResourceFile("links_test_data.php")[0];
        self::$ARRAY_LINK = new ArrayLinkImpl(self::$TEST_DATA);
    }

}
