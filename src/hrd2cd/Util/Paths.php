<?php
/** @noinspection ALL */

namespace Hard2Code\Util;

final class Paths
{

    /**
     * @param  string  $file
     *
     * @return bool
     */
    public static function isAbsolute(string $file): bool
    {
        if ($file === "") {
            return false;
        }

        if (str_contains($file, "http")) {
            return true;
        }

        return $file[0] === DIRECTORY_SEPARATOR || preg_match('~\A[A-Z]:(?![^/\\\\])~i', $file) > 0;
    }

    /**
     * @param  string  $path  relative path to directory
     *
     * @return array
     */
    public static function listDirectory(string $path): array
    {
        return listDirectory($_SERVER["DOCUMENT_ROOT"]."/".$path);
    }

    /**
     * @param  string  $src
     *
     * @return string|null
     */
    public static function getFileName(string $src): ?string
    {
        return pathinfo($src)["basename"] ?? null;
    }

    /**
     * @param  string  $src
     * @param  string  $extension
     *
     * @return string|null
     */
    public static function getFileNameWithExtension(string $src, string $extension): ?string
    {
        return pathinfo($src)["basename"].".".$extension;
    }

}
