<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Util\Formatters;
use PHPUnit\Framework\TestCase;

class FormattersTest extends TestCase
{

    public function testFormatPrice()
    {
        self::assertEquals("100", Formatters::formatPrice(100.0));
        self::assertEquals("1 000", Formatters::formatPrice(1000.000));
        self::assertEquals("10 000", Formatters::formatPrice(10000.0000));
    }

}
