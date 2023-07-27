<?php

namespace Hard2Code\Util;

use Throwable;

final class Properties
{

    /**
     * Returns unique values by property id
     * Sorting by value ascending
     *
     * @param  int  $propertyId
     *
     * @return array
     */
    public static function getUniqueValuesByPropertyId(int $propertyId): array
    {
        global $DB;

        $result = self::getPropertyMeta($propertyId);
        $resultSet = $DB->Query("SELECT ID, VALUE, VALUE_NUM
                                    FROM b_iblock_element_property
                                    WHERE IBLOCK_PROPERTY_ID = $propertyId
                                    GROUP BY VALUE
                                    ORDER BY VALUE ASC");

        // Try to lookup property in b_iblock_property_enum table
        if ($resultSet->result->num_rows == 0) {
            $resultSet = $DB->Query("SELECT ID, VALUE 
                                    FROM b_iblock_property_enum
                                    WHERE PROPERTY_ID = $propertyId
                                    ORDER BY VALUE ASC");
            $result["type"] = "list";
        }

        while ($row = $resultSet->Fetch()) {
            $result["values"][] = (isset($row["VALUE_NUM"]) && (int) $row["VALUE_NUM"] > 0) ? (int) $row["VALUE_NUM"] : $row["VALUE"];
        }

        return $result;
    }

    /**
     * Returns min and max values by property id
     * Works correct only with numeric values
     *
     * @param  int  $propertyId
     *
     * @return array
     */
    public static function getMinAndMaxNumericValuesByPropertyId(int $propertyId): array
    {
        global $DB;

        $result = self::getPropertyMeta($propertyId);
        $resultSet = $DB->Query("SELECT MAX(VALUE_NUM) AS max, MIN(VALUE_NUM) AS min
                                            FROM b_iblock_element_property
                                                    WHERE IBLOCK_PROPERTY_ID = $propertyId")->Fetch();
        $result["type"] = "range";
        $result["values"] = [
            "min" => (int) $resultSet["min"],
            "max" => (int) $resultSet["max"]
        ];

        return $result;
    }

    /**
     * Returns unique values by property code
     * Sorting by value ascending
     *
     * @param  int     $iblockId
     * @param  string  $code
     *
     * @return array
     */
    public static function getUniqueValuesByCode(int $iblockId, string $code): array
    {
        global $DB;

        $propertyId = $DB->Query("SELECT ID FROM b_iblock_property WHERE IBLOCK_ID = $iblockId AND CODE = '$code'")->Fetch()["ID"];

        return self::getUniqueValuesByPropertyId($propertyId);
    }

    /**
     * @param  int     $iblockId
     * @param  string  ...$codes
     *
     * @return array
     */
    public static function getUniqueValuesByCodes(int $iblockId, string...$codes): array
    {
        $result = [];

        foreach ($codes as $code) {
            try {
                $result[] = self::getUniqueValuesByCode($iblockId, $code);
            } catch (Throwable) {
                continue;
            }
        }

        return count($codes) == 1 ? $result[0] : $result;
    }


    /**
     * Returns min and max values by property code
     * Works correct only with numeric values
     *
     * @param  int     $iblockId
     * @param  string  $code
     *
     * @return array
     */
    public static function getMinAndMaxNumericValuesByCode(int $iblockId, string $code): array
    {
        $propertyId = self::getPropertyIdByCode($iblockId, $code);

        return self::getMinAndMaxNumericValuesByPropertyId($propertyId);
    }


    /**
     * @param  int  $propertyId
     *
     * @return array
     */
    private static function getPropertyMeta(int $propertyId): array
    {
        global $DB;

        $result = [];
        $propertyMeta = $DB->Query("SELECT NAME, CODE, PROPERTY_TYPE FROM b_iblock_property WHERE ID = $propertyId")->Fetch();
        $result["name"] = $propertyMeta["NAME"];
        $result["code"] = $propertyMeta["CODE"];
        $result["type"] = PropertyTypes::formatPropertyType($propertyMeta["PROPERTY_TYPE"]);
        $result["values"] = [];

        return $result;
    }

    /**
     * @param  int     $iblockId
     * @param  string  $code
     *
     * @return int
     */
    private static function getPropertyIdByCode(int $iblockId, string $code): int
    {
        global $DB;

        return $DB->Query("SELECT ID FROM b_iblock_property WHERE IBLOCK_ID = $iblockId AND CODE = '$code'")->Fetch()["ID"] ?? -1;
    }
}
