<?php

namespace Hard2Code\Tests;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase {

    public function testIsHome() {
        $_SERVER["REQUEST_URI"] = "/";

        self::assertTrue(isHomePage());

        $_SERVER["REQUEST_URI"] = "/test/subdir/";

        self::assertFalse(isHomePage());
    }

}
