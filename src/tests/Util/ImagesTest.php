<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Entity\Picture\ArrayPicture;
use Hard2Code\Tests\Entities\EntityTestBase;
use PHPUnit\Framework\TestCase;


class ImagesTest extends EntityTestBase
{
    private static array $TEST_DATA;


    public function testGetPhotogallery()
    {
        foreach (self::$TEST_DATA as $image) {
            self::assertNotNull($image);
            self::assertInstanceOf(ArrayPicture::class, $image);
        }
    }

    protected function setUp(): void
    {
        self::$TEST_DATA = $this->includeResourceFile("photogallery_test_data.php");
    }

}
