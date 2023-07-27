<?php

namespace Hard2Code\Util;

final class Formatters
{

    /**
     * @param  float  $number
     *
     * @return string
     */
    public static function formatPrice(float $number): string
    {
        return Formatters::formatNumber($number, "", " ");
    }


    /**
     * @param  float   $number
     * @param  string  $decimalSeparator
     * @param  string  $thousandsSeparator
     *
     * @return string
     */
    public static function formatNumber(float $number, string $decimalSeparator, string $thousandsSeparator): string
    {
        return number_format($number, 0, $decimalSeparator, $thousandsSeparator);
    }

}
