<?php

namespace Hard2Code\Util;

use CBXSanitizer;

/**
 * Utility class for sanitize strings
 * Wrapper above CBXSanitizer class
 */
final class Sanitizer
{

    private static ?CBXSanitizer $instance = null;


    public static function getInstance(): CBXSanitizer
    {
        if (self::$instance == null) {
            self::$instance = new CBXSanitizer();
        }

        return self::$instance;
    }

    /**
     * @param  string  $val
     *
     * @return string
     */
    public static function sanitize(string $val): string
    {
        return self::getInstance()->SanitizeHtml($val);
    }

    public static function sanitizeRecursively(array &$fields): array
    {
        if (empty($fields)) {
            return $fields;
        }

        $sanitizer = self::getInstance();

        array_walk_recursive($fields, function (&$value, $key) use ($sanitizer) {
            if (!is_string($value)) {
                return;
            }

            $value = $sanitizer->SanitizeHtml($value);
        });

        return $fields;
    }
}
