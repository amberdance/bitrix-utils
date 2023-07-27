<?php

namespace Hard2Code\Entity\Section;


use Hard2Code\Entity\ArrayItemBase;
use Hard2Code\Entity\Picture\ArrayPicture;
use Hard2Code\Entity\Picture\ArrayPictureImpl;
use Hard2Code\Util\Images;
use Hard2Code\Util\Strings;

class ArraySectionImpl extends ArrayItemBase implements ArraySection
{


    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getByKey("name");
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->getByKey("description");
    }

    /**
     * @inheritDoc
     */
    public function getCode(): ?string
    {
        return $this->getByKey("code");
    }

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return $this->getByKey("global_active") == "Y";
    }

    /**
     * @inheritDoc
     */
    public function getPicture(): ?ArrayPicture
    {
        $rawPicture = $this->getByKey("picture");

        if (!$rawPicture) {
            return null;
        }

        return new ArrayPictureImpl($rawPicture);
    }

    /**
     * @inheritDoc
     */
    public function getIblockSectionId(): ?int
    {
        return $this->getByKey("iblock_section_id");
    }

    /**
     * @inheritDoc
     */
    public function getListPageUrl(): string
    {
        return $this->getByKey("list_page_url");
    }

    /**
     * @inheritDoc
     */
    public function getSectionPageUrl(): string
    {
        return $this->getByKey("section_page_url");
    }

    /**
     * @inheritDoc
     */
    public function getIblockCode(): string
    {
        return $this->getByKey("iblock_code");
    }

    /**
     * @inheritDoc
     */
    public function getEditLink(): string
    {
        return $this->getByKey("edit_link");
    }

    /**
     * @inheritDoc
     */
    public function getDeleteLink(): string
    {
        return $this->getByKey("delete_link");
    }

    /**
     * @inheritDoc
     */
    public function getElementCount(): int
    {
        return $this->getByKey("element_cnt") ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->getElementCount() > 0;
    }

    /**
     * @inheritDoc
     */
    public function getDepthLevel(): int
    {
        return (int) $this->getByKey("depth_level");
    }

    /**
     * @inheritDoc
     */
    public function getResizedPicture(int $height, int $width, bool $isProportional = true): ?ArrayPicture
    {
        return Images::getResizedImage($this->getByKey("picture")["ID"], $isProportional, $height, $width);
    }


    /**
     * @param  string  $key  key without UF_ prefix
     *
     * @return mixed
     */
    public function getUfProperty(string $key): mixed
    {
        return $this->data["UF_".Strings::toUpperCase($key)] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function hasDescription(): bool
    {
        $description = $this->getByKey("description");

        return is_string($description) && strlen($description > 0);
    }
}
