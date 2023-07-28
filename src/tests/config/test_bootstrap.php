<?php

<<<<<<< HEAD:src/tests/config/test_bootstrap.php
require __DIR__."/../../../vendor/autoload.php";
=======
require __DIR__."/../../vendor/autoload.php";
>>>>>>> c1cea50df1b95c54a486cd8f7d1c2d8d076a2d03:src/tests/test_bootstrap.php

$_SERVER["DOCUMENT_ROOT"] = dirname(__DIR__, 3);


const NO_KEEP_STATISTIC = true;
const NOT_CHECK_PERMISSIONS = true;
const LOG_FILENAME = 'php://stderr';

if (file_exists($bitrixPrologBefore = $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")) {
    require $bitrixPrologBefore;
}
