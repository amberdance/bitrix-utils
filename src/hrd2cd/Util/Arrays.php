<?php

namespace Hard2Code\Util;

final class Arrays
{

    /**
     * @param  array  $a  first array to compare
     * @param  array  $b  second array to compare
     *
     * @return bool
     */
    public static function equals(array $a, array $b): bool
    {
        return serialize($a) === serialize($b);
    }

}
