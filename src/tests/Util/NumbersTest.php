<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Util\Numbers;
use PHPUnit\Framework\TestCase;

class NumbersTest extends TestCase
{
    function testPositive()
    {
        self::assertTrue(Numbers::isPositive(1));
        self::assertFalse(Numbers::isPositive(0));
        self::assertFalse(Numbers::isPositive(-1));
    }

    function testNegative()
    {
        self::assertTrue(Numbers::isNegative(-1));
        self::assertFalse(Numbers::isNegative(0));
        self::assertFalse(Numbers::isNegative(1));
    }
}
