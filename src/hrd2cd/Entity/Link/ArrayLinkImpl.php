<?php

namespace Hard2Code\Entity\Link;

use Hard2Code\Entity\ArrayItemBase;
use Hard2Code\Util\Links;

class ArrayLinkImpl extends ArrayItemBase implements ArrayLink
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getByKey("text");
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->getName();
    }

    /**
     * @inheritDoc
     */
    public function getSource(): string
    {
        return $this->getByKey("link");
    }

    /**
     * @inheritDoc
     */
    public function isSelected(): bool
    {
        return $this->getByKey("selected");
    }

    /**
     * @inheritDoc
     */
    public function getPermission(): string
    {
        return $this->getByKey("permission");
    }

    /**
     * @inheritDoc
     */
    public function getParams(): array
    {
        return $this->getByKey("params");
    }

    /**
     * @inheritDoc
     */
    public function isParent(): bool
    {
        return $this->getByKey("is_parent");
    }

    /**
     * @inheritDoc
     */
    public function getDepthLevel(): int
    {
        return $this->getByKey("depth_level");
    }

    /**
     * @inheritDoc
     */
    public function getIndex(): int
    {
        return $this->getByKey("item_index");
    }

    /**
     * @inheritDoc
     */
    public function isAbsolute(): bool
    {
        return Links::isAbsolute($this->getSource());
    }

    /**
     * @inheritDoc
     */
    public function isRelative(): bool
    {
        return !Links::isAbsolute($this->getSource());
    }


}
