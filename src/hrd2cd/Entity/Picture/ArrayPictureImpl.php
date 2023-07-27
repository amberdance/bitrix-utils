<?php

namespace Hard2Code\Entity\Picture;

use Hard2Code\Entity\ArrayItemBase;
use Hard2Code\Util\Images;
use Hard2Code\Util\Paths;

class ArrayPictureImpl extends ArrayItemBase implements ArrayPicture
{

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->getByKey("id");
    }

    /**
     * @inheritDoc
     */
    public function getFileName(): string
    {
        return $this->getByKey("file_name");
    }

    /**
     * @inheritDoc
     */
    public function getSource(): string
    {
        return $this->getByKey("src");
    }

    /**
     * @inheritDoc
     */
    public function getContentType(): string
    {
        return $this->getByKey("content_type");
    }

    /**
     * @inheritDoc
     */
    public function getAlt(): string
    {
        return $this->getByKey("alt") ?? Paths::getFileName($this->getFileName());
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->getByKey("title");
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->getByKey("description") ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getWidth(): int
    {
        return (int) $this->getByKey("width");
    }

    /**
     * @inheritDoc
     */
    public function getHeight(): int
    {
        return (int) $this->getByKey("height");
    }

    /**
     * @inheritDoc
     */
    public function getFileSize(): int
    {
        return (int) $this->getByKey("file_size");
    }

    /**
     * Alias for getFileName
     *
     * @see ArrayItemBase::getName()
     * @see ArrayPicture::getFileName()
     */
    public function getName(): string
    {
        return $this->getFileName();
    }

    /**
     * @inheritDoc
     */
    public function getRawData(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function getBackgroundInlineStyle(): ?string
    {
        $src = $this->getSource();

        return $src ? Images::getBackgroundImageStyleAttribute($src) : null;
    }
}
