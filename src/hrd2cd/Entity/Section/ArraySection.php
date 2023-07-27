<?php

namespace Hard2Code\Entity\Section;


use Hard2Code\Entity\Picture\ArrayPicture;

/**
 * Abstraction of bitrix $arResult["SECTIONS"] array item
 */
interface ArraySection
{

    /**
     * Returns NAME property
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns DESCRIPTION property
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @return bool
     */
    public function hasDescription(): bool;

    /**
     * Returns CODE property
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Returns GLOBAL_ACTIVE property
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @return ArrayPicture|null
     */
    public function getPicture(): ?ArrayPicture;

    /**
     * @param  int   $height
     * @param  int   $width
     * @param  bool  $isProportional
     *
     * @return ArrayPicture|null
     */
    public function getResizedPicture(int $height, int $width, bool $isProportional = true): ?ArrayPicture;

    /**
     * Returns IBLOCK_SECTION_ID property
     *
     * @return int|null
     */
    public function getIblockSectionId(): ?int;

    /**
     * Returns LIST_PAGE_URL property
     *
     * @return string
     */
    public function getListPageUrl(): string;

    /**
     * Returns SECTION_PAGE_URL property
     *
     * @return string
     */
    public function getSectionPageUrl(): string;

    /**
     * Returns IBLOCK_CODE property
     *
     * @return string
     */
    public function getIblockCode(): string;

    /**
     * Returns EDIT_LINK property
     *
     * @return string
     */
    public function getEditLink(): string;

    /**
     * Returns DELETE_LINK property
     *
     * @return string
     */
    public function getDeleteLink(): string;

    /**
     * Returns count of elements of current section
     *
     * @return int
     */
    public function getElementCount(): int;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns DEPTH_LEVEL property
     *
     * @return int
     */
    public function getDepthLevel(): int;

    /**
     * Returns UF_ property
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function getUfProperty(string $key): mixed;
}
