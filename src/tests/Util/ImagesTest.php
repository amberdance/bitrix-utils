<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Entity\Picture\ArrayPicture;
use Hard2Code\Util\Images;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class ImagesTest extends TestCase
{

    private static $imageIds = [
        1938,
        1939,
        1940,
        1941
    ];


    public function testGetPhotogallery()
    {
        $images = Images::getPhotogallery(self::$imageIds);
        assertEquals(count(self::$imageIds), count($images));

        foreach ($images as $image) {
            self::assertNotNull($image);
            self::assertInstanceOf(ArrayPicture::class, $image);
            self::assertFileExists($_SERVER["DOCUMENT_ROOT"].$image->getSource());
        }
    }

}
