<?php

namespace Hard2Code\Tests\Entities;


use Hard2Code\Entity\Picture\ArrayPictureImpl;
use Hard2Code\Entity\Section\ArraySection;
use Hard2Code\Entity\Section\ArraySectionImpl;

use function PHPUnit\Framework\assertEquals;

class ArraySectionTest extends EntityTestBase
{

    private static array $TEST_DATA;

    private static ArraySection $ARRAY_SECTION;


    public function testGetName()
    {
        assertEquals(self::$TEST_DATA["NAME"], self::$ARRAY_SECTION->getName());
    }

    public function testGetCode()
    {
        assertEquals(self::$TEST_DATA["CODE"], self::$ARRAY_SECTION->getCode());
    }

    public function testGetDescription()
    {
        assertEquals(self::$TEST_DATA["DESCRIPTION"], self::$ARRAY_SECTION->getDescription());
    }


    public function testIsActive()
    {
        assertEquals(self::$TEST_DATA["GLOBAL_ACTIVE"] == "Y", self::$ARRAY_SECTION->isActive());
    }

    public function testGetPicture()
    {
        assertEquals(new ArrayPictureImpl(self::$TEST_DATA["PICTURE"]), self::$ARRAY_SECTION->getPicture());
    }

    public function testGetIblockSectionId()
    {
        assertEquals(self::$TEST_DATA["IBLOCK_SECTION_ID"], self::$ARRAY_SECTION->getIblockSectionId());
    }

    public function testGetListPageUrl()
    {
        assertEquals(self::$TEST_DATA["LIST_PAGE_URL"], self::$ARRAY_SECTION->getListPageUrl());
    }

    public function testGetSectionPageUrl()
    {
        assertEquals(self::$TEST_DATA["SECTION_PAGE_URL"], self::$ARRAY_SECTION->getSectionPageUrl());
    }


    public function testGetIblockCode()
    {
        assertEquals(self::$TEST_DATA["IBLOCK_CODE"], self::$ARRAY_SECTION->getIblockCode());
    }

    public function testGetEditLink()
    {
        assertEquals(self::$TEST_DATA["EDIT_LINK"], self::$ARRAY_SECTION->getEditLink());
    }


    public function testGetDeleteLink()
    {
        assertEquals(self::$TEST_DATA["DELETE_LINK"], self::$ARRAY_SECTION->getDeleteLink());
    }

    public function testGetElementCount()
    {
        assertEquals((int) self::$TEST_DATA["ELEMENT_CNT"], self::$ARRAY_SECTION->getElementCount());
    }


    public function testIsEmpty()
    {
        assertEquals((int) self::$TEST_DATA["ELEMENT_CNT"] > 0, self::$ARRAY_SECTION->isEmpty());
    }

    public function testGetDepthLevel()
    {
        assertEquals((int) self::$TEST_DATA["DEPTH_LEVEL"], self::$ARRAY_SECTION->getDepthLevel());
    }

    public function testGetUfProperty()
    {
        assertEquals(self::$TEST_DATA["UF_IMAGE"], self::$ARRAY_SECTION->getUfProperty("image"));
    }

    public function testHasDescription()
    {
        self::assertTrue(self::$ARRAY_SECTION->hasDescription());

        $sectionWithoutDescription = $this->includeResourceFile("sections_test_data.php")["SECTIONS"][1];
        $arraySection = new ArraySectionImpl($sectionWithoutDescription);

        self::assertFalse($arraySection->hasDescription());
    }

    protected function setUp(): void
    {
        self::$TEST_DATA = $this->includeResourceFile("sections_test_data.php")["SECTIONS"][0];
        self::$ARRAY_SECTION = new ArraySectionImpl(self::$TEST_DATA);
    }
}
