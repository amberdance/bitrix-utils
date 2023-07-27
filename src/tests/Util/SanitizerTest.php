<?php

namespace Hard2Code\Tests\Util;

use Hard2Code\Util\Sanitizer;
use PHPUnit\Framework\TestCase;

class SanitizerTest extends TestCase
{
    private static string $TEST_HTML = "<div></div><iframe></iframe><canvas id='1'></canvas>";
    private static string $TEST_SCRIPT = "<script>console.log(123)</script><?php echo 123?><?=123?>";


    public static function testSanitize()
    {
        self::assertEquals("", Sanitizer::sanitize(self::$TEST_HTML));
        self::assertEquals("", Sanitizer::sanitize((self::$TEST_SCRIPT)));
    }

    public static function testSanitizeRecursively()
    {
        $fields = [
            "key0" => self::$TEST_HTML,
            "key1" => self::$TEST_SCRIPT,
            true,
            123,
            "clean",
        ];

        Sanitizer::sanitizeRecursively($fields);

        self::assertEquals("", $fields["key0"]);
        self::assertEquals("", $fields["key1"]);
        self::assertIsBool($fields[0]);
        self::assertIsNumeric($fields[1]);
        self::assertIsString($fields[2]);
    }

}
