<?php

namespace Hard2Code\Util;

final class Formatters
{

    public const DEFAULT_DATE_FORMAT = "j F Y";

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
     * @param  float  $number
     * @param  string  $decimalSeparator
     * @param  string  $thousandsSeparator
     *
     * @return string
     */
    public static function formatNumber(float $number, string $decimalSeparator, string $thousandsSeparator): string
    {
        return number_format($number, 0, $decimalSeparator, $thousandsSeparator);
    }

    /**
     * @param  string  $format
     * @param  int     $timeStamp
     *
     * @return string
     */
    public static function formatDateWithBitrixFormatter(
        int $timeStamp,
        string $format = self::DEFAULT_DATE_FORMAT
    ): string {
        return FormatDate($format, $timeStamp);
    }

}
