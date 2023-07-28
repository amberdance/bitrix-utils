<?php

namespace Hard2Code\Entity\Item;

use Hard2Code\Entity\Picture\ArrayPicture;

/**
 * Array item is a base abstraction of any item of bitrix $arResult array
 */
interface ArrayItem
{

    /**
     * Returns CODE property
     *
     * @return string|null
     */
    public function getElementCode(): ?string;

    /**
     * Returns PREVIEW_TEXT property
     *
     * @param  bool  $isRawHtml
     *
     * @return string|null
     */
    public function getPreviewText(bool $isRawHtml = false): ?string;

    /**
     * Returns DETAIL_TEXT property
     *
     * @param  bool  $isRawHtml
     *
     * @return string|null
     */
    public function getDetailText(bool $isRawHtml = false): ?string;


    /**
     * @return ArrayPicture|null
     */
    public function getPreviewPicture(): ?ArrayPicture;

    /**
     * @return ArrayPicture|null
     */
    public function getDetailPicture(): ?ArrayPicture;

    /**
     *  Works with images that's stores in bitrix db
     *
     * @param  int   $height
     * @param  int   $width
     * @param  bool  $isProportional
     *
     * @return ArrayPicture|null
     */
    public function getResizedPreviewPicture(int $width, int $height, bool $isProportional = true): ?ArrayPicture;

    /**
     * Works with images that's stores in bitrix db
     *
     * @param  int   $width
     * @param  int   $height
     * @param  bool  $isProportional
     *
     * @return ArrayPicture|null
     */
    public function getResizedDetailPicture(int $width, int $height, bool $isProportional = true): ?ArrayPicture;

    /**
     * Returns DETAIL_PAGE_URL property
     *
     * @return string|null
     */
    public function getDetailPageUrl(): ?string;

    /**
     * Returns all custom properties of info block
     *
     * @return array|null
     */
    public function getIblockProperties(): ?array;


    /**
     * Returns users custom info block property if exists
     *
     * @param  string  $property
     *
     * @return mixed
     */
    public function getIblockProperty(string $property): mixed;

    /**
     * @return bool
     */
    public function hasPreviewText(): bool;

    /**
     * @return bool
     */
    public function hasDetailText(): bool;

    /**
     * @return array
     */
    public function getTags(): array;

}
