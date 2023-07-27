<?php

namespace Hard2Code\Tests\Entities;


use Hard2Code\Entity\Item\ArrayItem;
use Hard2Code\Entity\Item\ArrayItemImpl;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNull;

class ArrayItemTest extends EntityTestBase
{

    private static array $TEST_DATA;
    private static ArrayItem $ARRAY_ITEM;

    public static function testGetDetailPageUrl()
    {
        assertEquals(self::$ARRAY_ITEM->getDetailPageUrl(), self::$TEST_DATA["DETAIL_PAGE_URL"]);
    }

    public function testGetName()
    {
        assertEquals(self::$ARRAY_ITEM->getName(), self::$TEST_DATA["NAME"]);
    }

    public function testGetElementCode()
    {
        assertEquals(self::$TEST_DATA["CODE"], self::$ARRAY_ITEM->getElementCode());
    }


    public function testGetValue()
    {
        foreach (self::$TEST_DATA as $key => $value) {
            assertEquals(self::$ARRAY_ITEM->getValue($key), self::$TEST_DATA[$key]);
        }
    }

    public function testGetRawArrayResult()
    {
        assertEquals(self::$ARRAY_ITEM->getRawArrayResult(), self::$TEST_DATA);
    }

    public function testGetDetailText()
    {
        assertEquals(self::$ARRAY_ITEM->getDetailText(), self::$TEST_DATA["DETAIL_TEXT"]);
        assertEquals(self::$ARRAY_ITEM->getDetailText(true), self::$TEST_DATA["~DETAIL_TEXT"]);
    }

    public function testGetPreviewText()
    {
        assertEquals(self::$ARRAY_ITEM->getPreviewText(), self::$TEST_DATA["PREVIEW_TEXT"]);
        assertEquals(self::$ARRAY_ITEM->getPreviewText(true), self::$TEST_DATA["~PREVIEW_TEXT"]);
    }


    public function testHasPreviewText()
    {
        self::assertTrue(self::$ARRAY_ITEM->hasPreviewText());

        $data = ["PREVIEW_TEXT" => ""];
        $resultItem = new ArrayItemImpl($data);
        assertFalse($resultItem->hasPreviewText());
    }

    public function testHasDetailText()
    {
        self::assertTrue(self::$ARRAY_ITEM->hasDetailText());

        $data = ["DETAIL_TEXT" => ""];
        $resultItem = new ArrayItemImpl($data);
        assertFalse($resultItem->hasDetailText());
    }

    public function testGetIblockProperty()
    {
        $propertiesKey = self::$TEST_DATA["PROPERTIES"];
        assertEquals($propertiesKey["BOOLEAN"], self::$ARRAY_ITEM->getIblockProperty("BOOLEAN"));
        assertEquals($propertiesKey["EMPTY_STRING"], self::$ARRAY_ITEM->getIblockProperty("EMPTY_STRING"));
        assertEquals($propertiesKey["STRING"], self::$ARRAY_ITEM->getIblockProperty("STRING"));
        assertEquals($propertiesKey["ARRAY"], self::$ARRAY_ITEM->getIblockProperty("ARRAY"));
        assertNull(self::$ARRAY_ITEM->getIblockProperty("NULL"));
    }

    public function testGetIblockProperties()
    {
        assertEquals(self::$TEST_DATA["PROPERTIES"], self::$ARRAY_ITEM->getIblockProperties());
    }

    public function testGetPreviewPicture()
    {
        assertEquals(self::$TEST_DATA["PREVIEW_PICTURE"]["ID"], self::$ARRAY_ITEM->getPreviewPicture()->getId());
    }

    public function testGetDetailPicture()
    {
        assertEquals(self::$TEST_DATA["DETAIL_PICTURE"]["ID"], self::$ARRAY_ITEM->getDetailPicture()->getId());
    }


    protected function setUp(): void
    {
        $rawTestData = $this->includeResourceFile("array_result_test_data.php");
        self::$TEST_DATA = $rawTestData["ITEMS"][0];
        self::$ARRAY_ITEM = new ArrayItemImpl(self::$TEST_DATA);
    }

}
