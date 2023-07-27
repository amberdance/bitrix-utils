<?php
/** @noinspection ALL */

namespace Hard2Code\Util;

use CFile;
use Hard2Code\Entity\Picture\ArrayPicture;
use Hard2Code\Entity\Picture\ArrayPictureImpl;

final class Images
{

    public const DEFAULT_WIDTH = 1500;

    public const DEFAULT_HEIGHT = 1500;


    /**
     * @param  int       $imageId
     * @param  bool      $isProportional
     * @param  int|null  $width
     * @param  int|null  $height
     *
     * @return ArrayPicture|null
     */
    public static function getResizedImage(
        ?int $imageId,
        bool $isProportional = false,
        ?int $width = self::DEFAULT_WIDTH,
        ?int $height = self::DEFAULT_HEIGHT
    ): ?ArrayPicture {
        if ($imageId == null) {
            return null;
        }

        $resizedImageTmp = CFile::ResizeImageGet(
            $imageId,
            [
                "width"  => $width,
                "height" => $height,
            ],

            $isProportional ? BX_RESIZE_IMAGE_PROPORTIONAL : BX_RESIZE_IMAGE_EXACT,
            true
        );

        if (!$resizedImageTmp) {
            return null;
        }

        $result = CFile::GetFileArray($imageId);
        $result = array_merge($result, [
            "SRC"       => $resizedImageTmp["src"],
            "FILE_NAME" => Paths::getFileName($resizedImageTmp["src"]),
            "HEIGHT"    => $resizedImageTmp["height"],
            "WIDTH"     => $resizedImageTmp["width"],
            "FILE_SIZE" => $resizedImageTmp["size"]
        ]);


        return new ArrayPictureImpl($result);
    }

    /**
     * @param  ?string  $imageSrc
     *
     * @return string
     */
    public static function getBackgroundImageStyleAttribute(?string $imageSrc): string
    {
        return "background-image:url('".preg_replace("/\s/", "%20", $imageSrc)."');";
    }


    /**
     *
     * @param  array  $imageIds
     * @param  int    $width
     * @param  int    $height
     *
     * @return ArrayPicture[]
     */
    public static function getPhotogallery(
        array $imageIds,
        bool $isProportional = true,
        int $width = self::DEFAULT_WIDTH,
        int $height = self::DEFAULT_HEIGHT
    ): array {
        $result = [];

        foreach ($imageIds as $id) {
            $image = Images::getResizedImage($id, $isProportional, $width, $height);

            if ($image == null) {
                continue;
            }

            $result[] = $image;
        }

        return $result;
    }

}
