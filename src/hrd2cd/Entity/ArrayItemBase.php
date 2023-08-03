<?php

namespace Hard2Code\Entity;

use CBitrixComponentTemplate;
use Hard2Code\Util\Strings;

/**
 * Abstraction of any element of $arResult or simple array of bitrix payload.
 * Contains implementations of properties common to all elements any bitrix arrays
 */
abstract class ArrayItemBase implements ArrayElement
{

    protected array $data;

    private ?CBitrixComponentTemplate $componentContext = null;


    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->data["ID"] ?? -1;
    }

    /**
     * @inheritDoc
     */
    public function getLink(): string
    {
        return $this->data["DETAIL_PAGE_URL"] ?? $this->data["SECTION_PAGE_URL"] ?? $this->data["LINK"] ?? $this->data["SRC"];
    }

    /**
     * @inheritDoc
     */
    public function getValue(string $value): mixed
    {
        return $this->data[Strings::toUpperCase($value)];
    }

    /**
     * @inheritDoc
     */
    public function getRawArrayResult(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function getActiveFromDate(): ?string
    {
        return $this->getByKey("date_active_from") ?? $this->getByKey("active_from");
    }

    /**
     * @inheritDoc
     */
    public function getCreatedDate(): string
    {
        return $this->getByKey("date_create");
    }

    /**
     * @inheritDoc
     */
    public function getModifiedDate(): string
    {
        return $this->getByKey("timestamp_x");
    }

    /**
     * @inheritDoc
     */
    public function getActiveToDate(): ?string
    {
        return $this->getByKey("date_active_to") ?? $this->getByKey("active_to");
    }

    /**
     * Retrieve first available date value
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->getActiveFromDate() ?? $this->getCreatedDate() ?? $this->getModifiedDate();
    }


    /**
     * @inheritDoc
     */
    public function getBitrixEditAreaId(): ?string
    {
        if ($this->componentContext == null) {
            return null;
        }

        return "id=".$this->componentContext->GetEditAreaId($this->getId());
    }

    /**
     * @inheritDoc
     */
    public function setBitrixComponentContext(CBitrixComponentTemplate $context): void
    {
        $this->componentContext = $context;
    }


    /**
     * @param  string|null  ...$keys
     *
     * @return bool|string|array|null
     */
    protected function getByKey(?string ...$keys): bool|string|array|null
    {
        if (count($keys) == 1) {
            return $this->data[Strings::toUpperCase($keys[0])] ?? null;
        }

        foreach ($keys as $key) {
            $key = Strings::toUpperCase($key);

            if (isset($this->data[$key])) {
                return $this->data[$key];
            }
        }

        return null;
    }


}
