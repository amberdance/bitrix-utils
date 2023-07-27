<?php

namespace Hard2Code\Entity\Link;

/**
 * Array link is a base abstraction of any link of bitrix $aMenuLinks array
 */
interface ArrayLink
{

    /**
     * Returns link title
     *
     * @return string
     * @see ArrayElement::getName() aliase methods
     */
    public function getTitle(): string;

    /**
     * Returns LINK property
     *
     * @return string
     */
    public function getSource(): string;

    /**
     * Returns SELECTED property
     *
     * @return bool
     */
    public function isSelected(): bool;

    /**
     * Returns PERMISSION property
     *
     * @return string
     */
    public function getPermission(): string;

    /**
     * Returns PERMISSION property
     *
     * @return array
     */
    public function getParams(): array;

    /**
     * Returns DEPTH_LEVEL property
     *
     * @return int
     */
    public function getDepthLevel(): int;

    /**
     * Returns IS_PARENT property
     *
     * @return bool
     */
    public function isParent(): bool;

    /**
     * Returns ITEM_INDEX property
     *
     * @return int
     */
    public function getIndex(): int;

    /**
     * @return bool
     */
    public function isAbsolute(): bool;

    /**
     * @return bool
     */
    public function isRelative(): bool;

}
