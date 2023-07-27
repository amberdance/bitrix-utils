<?php

namespace Hard2Code\Util;

final class PropertyTypes
{

    public const FILE_TYPE = "F";
    public const LIST_TYPE = "L";
    public const STRING_TYPE = "S";

    /**
     * @param  string  $type
     *
     * @return string
     */
    public static function formatPropertyType(string $type): string
    {
        $result = $type;

        switch ($type) {
            case self::STRING_TYPE:
                $result = "string";
                break;
            case self::FILE_TYPE:
                $result = "file";
                break;
            case self::LIST_TYPE:
                $result = "list";
                break;
        }

        return $result;
    }


}
