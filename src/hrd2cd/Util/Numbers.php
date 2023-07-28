<?php

namespace Hard2Code\Util;

final class Numbers
{
    /**
     * @param  int  $number
     *
     * @return bool
     */
    public static function isPositive(int $number): bool
    {
        return $number > 0;
    }

    /**
     * @param  int  $number
     *
     * @return bool
     */
    public static function isNegative(int $number): bool
    {
        return $number < 0;
    }
}
