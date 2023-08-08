<?php
/** @noinspection ALL */

namespace Hard2Code\Util;

use Bitrix\Main\Page\Asset;
use TypeError;

final class Assets
{

    public const  CSS_PREFIX = "/css";

    public const  JS_PREFIX = "/js";

    public const  FONTS_PREFIX = "/fonts";

    private static ?Asset $asset = null;

    /**
     * @param  string  ...$css
     *
     * @return void
     */
    public static function includeCss(string ...$css): void
    {
        $asset = self::getAsset();

        foreach ($css as $file) {
            $asset->addCss(self::resolvePath($file, self::CSS_PREFIX));
        }
    }

    /**
     * @param  string  ...$js
     *
     * @return void
     */
    public static function includeJs(string ...$js): void
    {
        $asset = self::getAsset();

        foreach ($js as $file) {
            $asset->addJs(self::resolvePath($file, self::JS_PREFIX));
        }
    }

    /**
     * @param  string  ...$scripts
     *
     * @return void
     */
    public static function includeDeferScript(string ...$scripts): void
    {
        $asset = self::getAsset();

        foreach ($scripts as $script) {
            $asset->addString("<script src='$script' defer></script>");
        }
    }


    /**
     * Include all javascript files in given path
     *
     * @param  string  ...$paths
     *
     * @return void
     */
    public static function includeJsRecursively(string ...$paths): void
    {
        $asset = self::getAsset();

        foreach ($paths as $path) {
            try {
                foreach (Paths::listDirectory(SITE_TEMPLATE_PATH.self::JS_PREFIX.$path) as $js) {
                    $__js = SITE_TEMPLATE_PATH.self::JS_PREFIX.$path."/".$js;

                    if (is_dir($_SERVER["DOCUMENT_ROOT"].$__js)) {
                        self::includeJsRecursively($path."/$js");
                    }

                    $asset->addJs($__js);
                }
            } catch (TypeError) {
                continue;
            }
        }
    }

    /**
     * Include all css files in given path
     *
     * @param  string  ...$paths
     *
     * @return void
     */
    public static function includeCssRecursively(string ...$paths): void
    {
        $asset = self::getAsset();

        foreach ($paths as $path) {
            try {
                foreach (Paths::listDirectory(SITE_TEMPLATE_PATH.self::CSS_PREFIX.$path) as $css) {
                    $__css = SITE_TEMPLATE_PATH.self::CSS_PREFIX.$path."/".$css;

                    if (is_dir($_SERVER["DOCUMENT_ROOT"].$__css)) {
                        self::includeCssRecursively($path."/$css");
                    }

                    $asset->addCss($__css);
                }
            } catch (TypeError) {
                continue;
            }
        }
    }

    /**
     * @return void
     */
    public static function includeFontsRecursively(): void
    {
        $asset = self::getAsset();

        foreach (Paths::listDirectory(SITE_TEMPLATE_PATH.self::FONTS_PREFIX) as $font) {
            $font = self::resolvePath($font, "/");
            $type = pathinfo($font)["extension"];
            $asset->addString("<link rel='preload' href='$font'  as='font' type='font/$type' crossorigin>");
        }
    }

    /**
     * @param  string  $key
     * @param  string  $value
     *
     * @return void
     */
    public static function includeMeta(string $key, string $value): void
    {
        $asset = self::getAsset();
        $asset->addString("<meta name='$key' content='$value'>");
    }

    /**
     * @param  array  $map  array contains key and value
     *
     * @return void
     */
    public static function includeMetas(array $map): void
    {
        $asset = self::getAsset();

        foreach ($map as $key => $value) {
            $asset->addString("<meta name='$key' content='$value'>");
        }
    }

    /**
     * @param  string  $keyName
     * @param  string  $key
     * @param  string  $value
     *
     * @return void
     */
    public static function includeMetaWithCustomName(string $keyName, string $key, string $value): void
    {
        $asset = self::getAsset();
        $asset->addString("<meta $keyName='$key' content='$value'>");
    }

    /**
     * @param  string  $key
     * @param  string  $value
     *
     * @return void
     */
    public static function includeHttpEquivMeta(string $key, string $value): void
    {
        $asset = self::getAsset();
        $asset->addString("<meta http-equiv='$key' content='$value'>");
    }

    /**
     * @param  array  $map
     *
     * @return void
     */
    public static function includeHttpEquivMetas(array $map): void
    {
        $asset = self::getAsset();

        foreach ($map as $key => $value) {
            $asset->addString("<meta http-equiv='$key' content='$value'>");
        }
    }

    /**
     * @param  string  ...$fonts
     *
     * @return void
     */
    public static function includeFonts(string...$fonts): void
    {
        $asset = self::getAsset();

        foreach ($fonts as $font) {
            $src = SITE_TEMPLATE_PATH.self::FONTS_PREFIX.$font;
            $type = pathinfo($src)["extension"];
            $asset->addString(
                "<link rel='preload' href='$src'  as='font' type='font/$type' crossorigin>"
            );
        }
    }

    /**
     * Include meta tags:
     * <pre>
     * "viewport"    => "width=device-width,initial-scale=1",
     * "robots"      => "index, follow",
     * "keywords"    => $siteName,
     * "description" => $siteName,
     * "Content-Type"    => "text/html; charset=UTF-8",
     * "X-UA-Compatible" => "IE=edge",
     * </pre>
     *
     * @return void
     */
    public static function includeDefaultMeta(): void
    {
        $siteName = getSiteName();

        Assets::includeHttpEquivMetas([
            "Content-Type"    => "text/html; charset=UTF-8",
            "X-UA-Compatible" => "IE=edge",
        ]);

        Assets::includeMetas([
            "viewport"    => "width=device-width,initial-scale=1",
            "robots"      => "index, follow",
            "keywords"    => $siteName,
            "description" => $siteName,
        ]);
    }

    public static function includeManifest(string $path): void
    {
        $asset = self::getAsset();
        $path = self::resolvePath($path);
        $asset->addString("<link rel='manifest' href='$path'>");
    }

    /**
     * @return Asset
     */
    private static function getAsset(): Asset
    {
        if (self::$asset == null) {
            self::$asset = Asset::getInstance();
        }

        return self::$asset;
    }


    /**
     * @param  string  $file
     * @param  string  $dir
     *
     * @return string
     */
    private static function resolvePath(string $file, string $dir = ""): string
    {
        return Links::isAbsolute($file) ? $file : SITE_TEMPLATE_PATH.$dir.$file;
    }

}
