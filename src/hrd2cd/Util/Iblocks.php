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

}
