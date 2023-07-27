<?php

namespace Hard2Code\Entity\Handler;


use CBitrixComponentTemplate;
use Hard2Code\Entity\Item\ArrayItem;
use Hard2Code\Entity\Link\ArrayLink;
use Hard2Code\Entity\Section\ArraySection;
use Hard2Code\Html\HtmlRenderer;

interface EntityHandler
{


    /**
     * Returns count of items
     *
     * @return int
     */
    public function size(): int;

    /**
     * Returns current index of element in loop
     *
     * @return int
     */
    public function getIndex(): int;

    /**
     * Returns size of items
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns value of $arResult by given key
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function get(string $key): mixed;

    /**
     * Returns items of $arResult with key 'ITEMS'
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Returns sections in SECTIONS property
     *
     * @return array
     */
    public function getSections(): array;

    /**
     * Returns current item outside of loop
     *
     * @return ArrayItem|null
     */
    public function getItem(): ?ArrayItem;

    /**
     * Returns current sections outside of loop
     *
     * @return ArraySection|null
     */
    public function getSection(): ?ArraySection;

    /**
     * Returns current link outside of loop
     *
     * @return ArrayLink|null
     */
    public function getLink(): ?ArrayLink;

    /**
     * Returns raw bitrix $arResult array
     *
     * @return array
     */
    public function getArrayResult(): array;


    /**
     * Returns current item in loop:
     *
     * <pre>
     * while($item = $handler->nextItem()) {
     * // do your stuff here...
     * }
     * </pre>
     *
     * @return ArrayItem|null
     */
    public function nextItem(): ?ArrayItem;

    /**
     * Returns current section in loop:
     *
     * <pre>
     * while($section =  $handler->nextSection()) {
     * // do your stuff here...
     * }
     * </pre>
     *
     * @return ArraySection|null
     */
    public function nextSection(): ?ArraySection;

    /**
     * Returns current link in loop:
     *
     * <pre>
     * while($link = $handler->nextLink()) {
     *  // do your stuff here...
     * }
     * </pre>
     *
     * @return ArrayLink|null
     */
    public function nextLink(): ?ArrayLink;

    /**
     * Initialized bitrix component context in template.
     * For example:
     *
     * <pre>
     * $handler = Entities::getHandler($arResult);
     * $handler->setComponentContext($this);
     * $handler->getComponentContext()->getEditAreaId("id");
     * </pre>
     *
     * @param  CBitrixComponentTemplate  $context
     *
     * @return void
     */
    public function setComponentContext(CBitrixComponentTemplate $context): void;


    /**
     * @return string|null
     */
    public function getArchiveLink(): ?string;

    /**
     * @return HtmlRenderer
     */
    public function getHtmlRenderer(): HtmlRenderer;

}
