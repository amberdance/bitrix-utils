<?php

/**
 * @param  mixed   $data
 * @param  string  $textColor
 * @param  string  $bgColor
 *
 * @return void
 */
function vardump(mixed $data, string $textColor = "#353535", string $bgColor = "#f8f8f8"): void {
    echo "<div class='container'>
    <pre style='background-color: $bgColor;
    color: $textColor;
    font-size: 15px;
    font-weight: bold;
    padding: 2rem 0;
    overflow:auto;
    white-space: break-spaces;'>";

    var_dump($data);
    echo "</pre></div>";
}

/**
 * @param  string  $rootPath
 *
 * @return bool
 */
function isHomePage(string $rootPath = "/"): bool {
    return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) == $rootPath;
}

/**
 * @param  string  $siteId
 *
 * @return string
 */
function getSiteName(string $siteId = 's1'): string {
    return CSite::GetByID($siteId)->arResult[0]['SITE_NAME'] ?? Constant::SITE_NAME;
}

/**
 * Includes template file located in includes directory relatively of current
 * template directory
 *
 * @param  string  $path
 *
 * @return void
 */
function includeTemplateFile(string $path): void {
    $path = $path[0] == "/" ? substr($path, 1) : $path;
    $path = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/includes/".$path;
    $hasExtension = isset(pathinfo($path)["extension"]);
    $fileSuffix = $hasExtension ? "" : ".php";

    // When path is root directory name
    if (is_dir($path)) {
        require_once $path."/index".$fileSuffix;
    } // When path is name of include file
    else {
        require_once $path.$fileSuffix;
    }
}

/**
 * @param  string  ...$paths
 *
 * @return void
 */
function includeTemplateFiles(string ...$paths): void {
    foreach ($paths as $path) {
        includeTemplateFile($path);
    }
}

/**
 * Includes template file located in includes directory relatively of current
 * site directory
 *
 * @param  string  $path
 *
 * @return void
 */
function includeSharedTemplateFile(string $path): void {
    $prefix = isHomePage() ? "" : $_SERVER["DOCUMENT_ROOT"].SITE_DIR;
    $file = $prefix."/includes/".$path;

    require_once $file;
}

/**
 * @return void
 */
function includeAdminPanelIfAuthenticated(): void {
    global $APPLICATION, $USER;

    if ($USER->isAdmin()) {
        echo "<div id='panel'>";
        $APPLICATION->ShowPanel();
        echo "</div>";
    }
}

/**
 * @return void
 */
function protectBitrixPrologInclude(): void {
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }
}

/**
 * Returns relative site url
 *
 * @return string
 */
function getSiteDir(): string {
    return Constant::IS_DEVELOPMENT_MODE ? Constant::DEVELOPMENT_SITE_DIR : SITE_DIR;
}

/**
 * @param  string  $dir  absolute path to directory
 *
 * @return array
 */
function listDirectory(string $dir): array {
    $list = array_diff(scandir($dir), ['..', '.']);

    return array_values($list);
}


/**
 * @return bool
 */
function issetHttpReferer(): bool {
    return $_SERVER["HTTP_REFERER"] !== null;
}
