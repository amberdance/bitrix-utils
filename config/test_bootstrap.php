<?php

require __DIR__."/../vendor/autoload.php";

$_SERVER["DOCUMENT_ROOT"] = dirname(__DIR__, 3);


const NO_KEEP_STATISTIC = true;
const NOT_CHECK_PERMISSIONS = true;
const LOG_FILENAME = 'php://stderr';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
