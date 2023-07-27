<?php

namespace Hard2Code\Util;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Web\Json;
use CBitrixComponent;

final class Signer
{

    public const SIGN_PARAMS_KEY = "signedParameters";

    private function __construct()
    {
    }


    public static function signParametersFromComponent(
        CBitrixComponent $component,
        string $key = self::SIGN_PARAMS_KEY
    ): string {
        try {
            return Json::encode([$key => $component->getSignedParameters()]);
        } catch (ArgumentException) {
            return "";
        }
    }


}
