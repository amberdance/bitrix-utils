<?php

namespace Hard2Code\Util;

final class Links
{

    /**
     * @param  string  $link
     *
     * @return bool
     */
    public static function isAbsolute(string $link): bool
    {
        return is_numeric(strpos($link, "http"));
    }

    /**
     * Returns target attribute _self if relative link _blank otherwise
     *
     * @param  string  $link
     *
     * @return string
     */
    public static function getTargetAttribute(string $link): string
    {
        return self::isAbsolute($link) ? "target='_blank'" : "target='_self'";
    }

}
