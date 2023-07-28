<?php

namespace Hard2Code\Tests\Entities;


use Hard2Code\Entity\Handler\EntityHandler;
use Hard2Code\Entity\Item\ArrayItem;
use Hard2Code\Entity\Link\ArrayLink;
use Hard2Code\Entity\Section\ArraySection;
use Hard2Code\Util\Entities;

class EntityHandlerTest extends EntityTestBase
{

    private static array $TEST_ITEMS_DATA;
    private static array $TEST_LINKS_DATA;
    private static array $TEST_SECTIONS_DATA;
    private static EntityHandler $HANDLER;


    public function testGetIndex()
    {
        $realIndex = 0;
        $expectedIndex = 0;

        self::assertEquals(self::$HANDLER->getIndex(), $realIndex);

        while (self::$HANDLER->nextItem()) {
            $expectedIndex = self::$HANDLER->getIndex();
            $realIndex++;
        }

        self::assertEquals($expectedIndex, $realIndex);
    }

    public function testIsEmpty()
    {
        $emptyData = ["ITEMS" => []];
        self::assertTrue(Entities::getHandler($emptyData)->isEmpty());

        $emptyData = [];
        self::assertTrue(Entities::getHandler($emptyData)->isEmpty());
    }


    public function testNextItem()
    {
        $i = 0;

        while ($item = self::$HANDLER->nextItem()) {
            self::assertEquals(self::$TEST_ITEMS_DATA["ITEMS"][$i], $item->getRawArrayResult());
            $i++;
        }
    }

    public function testNextLink()
    {
        $handler = Entities::getHandler(self::$TEST_LINKS_DATA);
        $i = 0;

        while ($link = $handler->nextLink()) {
            self::assertEquals(self::$TEST_LINKS_DATA[$i], $link->getRawArrayResult());
            $i++;
        }
    }

    public function testNextSection()
    {
        $handler = Entities::getHandler(self::$TEST_SECTIONS_DATA);
        $i = 0;

        while ($section = $handler->nextSection()) {
            self::assertEquals(self::$TEST_SECTIONS_DATA["SECTIONS"][$i], $section->getRawArrayResult());
            $i++;
        }
    }

    public function testSize()
    {
        self::assertEquals(count(self::$TEST_ITEMS_DATA["ITEMS"]), self::$HANDLER->size());
    }

    public function testGet()
    {
        $handler = Entities::getHandler(self::$TEST_LINKS_DATA);

        foreach (self::$TEST_LINKS_DATA as $key => $value) {
            self::assertEquals($value, $handler->get($key));
        }
    }

    public function testGetArrayResult()
    {
        self::assertEquals(self::$TEST_ITEMS_DATA, self::$HANDLER->getArrayResult());
    }

    public function testGetArchiveLink()
    {
        self::assertEquals(self::$TEST_ITEMS_DATA["LIST_PAGE_URL"], self::$HANDLER->getArchiveLink());
    }

    public function testGetLinks()
    {
        $links = Entities::getLinks(self::$TEST_LINKS_DATA);

        foreach ($links as $i => $link) {
            self::assertInstanceOf(ArrayLink::class, $link);
            self::assertEquals(self::$TEST_LINKS_DATA[$i], $link->getRawArrayResult());
        }
    }

    public function testGetSectionsProperty()
    {
        self::assertEquals(self::$TEST_SECTIONS_DATA["SECTIONS"],
            Entities::getHandler(self::$TEST_SECTIONS_DATA)->getSections());
    }

    public function testGetSections()
    {
        $sections = Entities::getSections(self::$TEST_SECTIONS_DATA);

        foreach ($sections as $i => $section) {
            self::assertInstanceOf(ArraySection::class, $section);
            self::assertEquals(self::$TEST_SECTIONS_DATA["SECTIONS"][$i], $section->getRawArrayResult());
        }
    }

    public function testGetItems()
    {
        $items = Entities::getItems(self::$TEST_ITEMS_DATA);

        foreach ($items as $i => $item) {
            self::assertInstanceOf(ArrayItem::class, $item);
            self::assertEquals(self::$TEST_ITEMS_DATA["ITEMS"][$i], $item->getRawArrayResult());
        }
    }

    protected function setUp(): void
    {
        self::$TEST_ITEMS_DATA = $this->includeResourceFile("array_result_test_data.php");
        self::$TEST_LINKS_DATA = $this->includeResourceFile("links_test_data.php");
        self::$TEST_SECTIONS_DATA = $this->includeResourceFile("sections_test_data.php");
        self::$HANDLER = Entities::getHandler(self::$TEST_ITEMS_DATA);
    }

}
