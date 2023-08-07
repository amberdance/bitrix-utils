<?php

namespace Hard2Code\Util;

use CIBlock;
use CModule;

final class Iblocks
{

    /**
     * @param  string  $type
     *
     * @return array
     */
    public static function getIblocksByType(string $type): array
    {
        CModule::IncludeModule("iblock");

        $iblocks = [];
        $iblocksRs = CIBlock::GetList(
            [
                "NAME" => "ASC",
            ],
            [
                "TYPE" => $type,
            ]
        );

        while ($iblock = $iblocksRs->Fetch()) {
            $iblocks[] = $iblock;
        }

        return $iblocks;
    }

    /**
     * @param  int  $id
     *
     * @return string|null
     */
    public static function getName(int $id): ?string
    {
        global $DB;

        return $DB->Query("select NAME from b_iblock where ID=$id")->Fetch()["NAME"];
    }

    /**
     * @param  int  $iblockId
     *
     * @return int
     */
    public static function getSectionsCount(int $iblockId): int
    {
        global $DB;

        return $DB->Query("select count(ID) as counter from b_iblock_section where IBLOCK_ID=".$iblockId)->Fetch()["counter"] ?? -1;
    }

    /**
     * @param  int  $parentSectionId
     *
     * @return int
     */
    public static function getChildrenSectionsCount(int $parentSectionId): int
    {
        global $DB;

        return $DB->Query("select count(ID) as counter from b_iblock_section where IBLOCK_SECTION_ID=".$parentSectionId)->Fetch()["counter"] ?? -1;
    }

}
