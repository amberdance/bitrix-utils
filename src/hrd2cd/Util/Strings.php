<?php

namespace Hard2Code\Util;

final class Strings
{

    /**
     * @param  string  $val
     *
     * @return string
     */
    public static function toUpperCase(string $val): string
    {
        return strtoupper($val);
    }

}
