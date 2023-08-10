<?php

namespace Hard2Code\Entity\Item;

use Hard2Code\Entity\ArrayItemBase;
use Hard2Code\Entity\Picture\ArrayPicture;
use Hard2Code\Entity\Picture\ArrayPictureImpl;
use Hard2Code\Util\Images;
use Hard2Code\Util\Strings;

class ArrayItemImpl extends ArrayItemBase implements ArrayItem
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getByKey("name", "title", "text");
    }

    /**
     * @inheritDoc
     */
    public function getElementCode(): ?string
    {
        $code = $this->getByKey("code");

        return $code == "" ? null : $code;
    }

    /**
     * @inheritDoc
     */
    public function getDetailPageUrl(): ?string
    {
        return $this->getByKey("section_page_url", "detail_page_url");
    }


    /**
     *
     * @inheritDoc
     */
    public function getPreviewText(bool $stripTags = false): ?string
    {
        $key = "preview_text";

        if ($stripTags) {
            $key = "~".$key;
        }

        return $this->getByKey($key);
    }

    /**
     *
     * @inheritDoc
     */
    public function getDetailText(bool $stripTags = false): ?string
    {
        $key = "detail_text";

        if ($stripTags) {
            $key = "~".$key;
        }

        return $this->getByKey($key);
    }

    /**
     * @inheritDoc
     */
    public function getPicture(): ?ArrayPicture
    {
        $image = $this->getByKey("preview_picture", "detail_picture");

        if (!$image) {
            return null;
        }

        return new ArrayPictureImpl($image);
    }

    /**
     * @inheritDoc
     */
    public function getResizedPicture(int $width, int $height, bool $isProportional = true): ?ArrayPicture
    {
        return Images::getResizedImage($this->getByKey("preview_picture")["ID"] ?? $this->getByKey("detail_picture")["ID"],
            $isProportional, $width, $height);
    }

    /**
     * @inheritDoc
     */
    public function getPreviewPicture(): ?ArrayPicture
    {
        $image = $this->getByKey("preview_picture");

        if (!$image) {
            return null;
        }

        return new ArrayPictureImpl($image);
    }

    /**
     * @inheritDoc
     */
    public function getDetailPicture(): ?ArrayPicture
    {
        $image = $this->getByKey("detail_picture");

        if (!$image) {
            return null;
        }

        return new ArrayPictureImpl($image);
    }

    /**
     * @inheritDoc
     */
    public function getResizedPreviewPicture(int $width, int $height, bool $isProportional = true): ?ArrayPicture
    {
        return Images::getResizedImage($this->getByKey("preview_picture")["ID"], $isProportional, $width, $height);
    }

    /**
     * @inheritDoc
     */
    public function getResizedDetailPicture(int $width, int $height, bool $isProportional = true): ?ArrayPicture
    {
        return Images::getResizedImage($this->getByKey("detail_picture")["ID"], $isProportional, $width, $height);
    }

    /**
     * @inheritDoc
     */
    public function getIblockProperties(): ?array
    {
        return $this->getByKey("PROPERTIES");
    }

    /**
     *
     * @inheritDoc
     */
    public function getIblockProperty(string $property): mixed
    {
        $prop = $this->data["PROPERTIES"][Strings::toUpperCase($property)];

        return $prop["VALUE"] ?? $prop ?? null;
    }

    /**
     * @inheritDoc
     */
    public function hasPreviewText(): bool
    {
        return boolval($this->getByKey("preview_text"));
    }

    /**
     * @inheritDoc
     */
    public function hasDetailText(): bool
    {
        return boolval($this->getByKey("preview_text"));
    }

    /**
     * @inheritDoc
     */
    public function getTags(): array
    {
        $tags = $this->getByKey("tags");

        if ($tags == null || $tags == "") {
            return [];
        }

        return explode(",", $tags);
    }

}
