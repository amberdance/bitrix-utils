<?php

namespace Hard2Code\Entity\Picture;

/**
 * Base abstraction of bitrix PREVIEW_PICTURE or DETAIL_PICTURE array
 */
interface ArrayPicture
{

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return string
     */
    public function getSource(): string;

    /**
     * @return string
     */
    public function getContentType(): string;

    /**
     * @return string
     */
    public function getAlt(): string;

    /**
     * Same result as getAlt() method
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return int
     */
    public function getFileSize(): int;

    /**
     * @return array
     */
    public function getRawData(): array;

    /**
     * @return string|null
     */
    public function getBackgroundInlineStyle(): ?string;


}
