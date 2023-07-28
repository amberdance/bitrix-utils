<?php

namespace Hard2Code\Entity;

use CBitrixComponentTemplate;
use Hard2Code\Entity\Handler\EntityHandler;

/**
 * Basic abstraction over a single element of bitrix $arResult
 */
interface ArrayElement
{

    /**
     * Returns ID property
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Returns property by given key
     *
     * @param  string  $value
     *
     * @return mixed
     */
    public function getValue(string $value): mixed;

    /**
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns original $arResult
     *
     * @return array
     */
    public function getRawArrayResult(): array;

    /**
     * Returns ACTIVE_FROM property
     *
     * @return string
     */
    public function getActiveFromDate(): string;

    /**
     * Returns DATE_CREATE property
     *
     * @return string
     */
    public function getCreatedDate(): string;

    /**
     * Returns TIMESTAMP_X property
     *
     * @return string
     */
    public function getModifiedDate(): string;

    /**
     * Returns ACTIVE_TO property
     *
     * @return string|null
     */
    public function getActiveToDate(): ?string;

    /**
     * Returns the id for the element that allows bitrix to delete or edit it
     * from the visual part of the site
     *
     * Can produce null if bitrix component context was not set
     *
     * @return string|null
     * @see EntityHandler::setComponentContext()
     */
    public function getBitrixEditAreaId(): ?string;

    /**
     * @param  CBitrixComponentTemplate  $context
     *
     * @return void
     */
    public function setBitrixComponentContext(CBitrixComponentTemplate $context): void;

}
