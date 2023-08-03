<?php

namespace Hard2Code\Tests\Entities;

use Hard2Code\Entity\Picture\ArrayPicture;
use Hard2Code\Entity\Picture\ArrayPictureImpl;

use function PHPUnit\Framework\assertEquals;

class ArrayPictureTest extends EntityTestBase
{

    private static array $TEST_DATA;
    private static ArrayPicture $ARRAY_PICTURE;

    public function testGetId()
    {
        assertEquals(self::$TEST_DATA["ID"], self::$ARRAY_PICTURE->getId());
    }


    public function testGetSource()
    {
        assertEquals(self::$TEST_DATA["SRC"], self::$ARRAY_PICTURE->getSource());
        assertEquals(self::$TEST_DATA["SRC"], self::$ARRAY_PICTURE->getLink());
    }

    public function testGetTitle()
    {
        assertEquals(self::$TEST_DATA["TITLE"], self::$ARRAY_PICTURE->getTitle());
    }

    public function testGetFileSize()
    {
        assertEquals(self::$TEST_DATA["FILE_SIZE"], self::$ARRAY_PICTURE->getFileSize());
    }

    public function testGetAlt()
    {
        assertEquals(self::$TEST_DATA["ALT"], self::$ARRAY_PICTURE->getAlt());
    }

    public function testGetDescription()
    {
        assertEquals(self::$TEST_DATA["DESCRIPTION"], self::$ARRAY_PICTURE->getDescription());
    }

    public function testGetWidth()
    {
        assertEquals(self::$TEST_DATA["WIDTH"], self::$ARRAY_PICTURE->getWidth());
    }

    public function testGetFileName()
    {
        assertEquals(self::$TEST_DATA["FILE_NAME"], self::$ARRAY_PICTURE->getFileName());
    }

    public function testGetContentType()
    {
        assertEquals(self::$TEST_DATA["CONTENT_TYPE"], self::$ARRAY_PICTURE->getContentType());
    }

    public function testGetHeight()
    {
        assertEquals(self::$TEST_DATA["HEIGHT"], self::$ARRAY_PICTURE->getHeight());
    }


    protected function setUp(): void
    {
        self::$TEST_DATA = $this->includeResourceFile("picture_test_data.php");
        self::$ARRAY_PICTURE = new ArrayPictureImpl(self::$TEST_DATA);
    }
}
