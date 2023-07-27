<?php
/** @noinspection ALL */

namespace Hard2Code\Entity\Handler;


use CBitrixComponentTemplate;
use CIBlock;
use Hard2Code\Entity\ArrayElement;
use Hard2Code\Entity\Item\ArrayItem;
use Hard2Code\Entity\Item\ArrayItemImpl;
use Hard2Code\Entity\Link\ArrayLink;
use Hard2Code\Entity\Link\ArrayLinkImpl;
use Hard2Code\Entity\Section\ArraySection;
use Hard2Code\Entity\Section\ArraySectionImpl;
use Hard2Code\Html\ArrayItemHtmlRenderer;
use Hard2Code\Html\HtmlRenderer;
use Hard2Code\Util\Strings;

class EntityHandlerImpl implements EntityHandler
{
    public const DEFAULT_ITEMS_KEY = "ITEMS";
    public const DEFAULT_SECTIONS_KEY = "SECTIONS";
    private array $data;
    private int $index = 0;
    private ?ArrayItem $currentItem = null;
    private ?ArrayLink $currentLink = null;
    private ?ArraySection $currentSection = null;
    private ?CBitrixComponentTemplate $componentContext = null;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return empty($this->getArrayResultWithNullCheck());
    }

    /**
     * @inheritDoc
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @inheritDoc
     */
    public function size(): int
    {
        return count($this->data[self::DEFAULT_SECTIONS_KEY] ?? $this->data[self::DEFAULT_ITEMS_KEY] ?? $this->data);
    }

    /**
     * @inheritDoc
     */
    public function getArrayResult(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): mixed
    {
        return $this->data[Strings::toUpperCase($key)];
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->getArrayResultWithNullCheck();
    }

    /**
     * @inheritDoc
     */
    public function getSections(): array
    {
        return $this->data[self::DEFAULT_SECTIONS_KEY];
    }

    /**
     * @inheritDoc
     */
    public function getItem(): ?ArrayItem
    {
        return $this->currentItem;
    }

    /**
     * @inheritDoc
     */
    public function getLink(): ?ArrayLink
    {
        return $this->currentLink;
    }

    /**
     * @inheritDoc
     */
    public function getSection(): ?ArraySection
    {
        return $this->currentSection;
    }


    /**
     * @inheritDoc
     */
    public function nextItem(): ?ArrayItem
    {
        $rawItem = $this->data[self::DEFAULT_ITEMS_KEY][$this->index] ??
            $this->data[$this->index];

        return $this->processLoop($rawItem, ArrayItem::class);
    }

    /**
     * @inheritDoc
     */
    public function nextLink(): ?ArrayLink
    {
        $rawLink = $this->data[$this->index];

        return $this->processLoop($rawLink, ArrayLink::class);
    }


    /**
     * @inheritDoc
     */
    public function nextSection(): ?ArraySection
    {
        $rawSection = $this->data[self::DEFAULT_SECTIONS_KEY][$this->index];

        return $this->processLoop($rawSection, ArraySection::class);
    }


    /**
     * @inheritDoc
     */
    public function setComponentContext(CBitrixComponentTemplate $context): void
    {
        if ($this->componentContext == null) {
            $this->componentContext = $context;
        }
    }


    /**
     * @inheritDoc
     */
    public function getArchiveLink(): ?string
    {
        return $this->data[self::DEFAULT_SECTIONS_KEY]['SECTION_PAGE_URL'] ??
            $this->data['LIST_PAGE_URL'] ?? $this->data['ORIGINAL_PARAMETERS']['SECTION_URL'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getHtmlRenderer(): HtmlRenderer
    {
        return ArrayItemHtmlRenderer::of($this);
    }


    private function addBitrixEditActionsIfComponentContextExists(): void
    {
        if ($this->componentContext == null) {
            return;
        }

        $element = $this->getCurrentElement();
        $element->setBitrixComponentContext($this->componentContext);
        $rawData = $element->getRawArrayResult();

        $this->componentContext->AddEditAction(
            $rawData["ID"],
            $rawData["EDIT_LINK"],
            CIBlock::GetArrayByID($rawData["IBLOCK_ID"], "ELEMENT_EDIT")
        );

        $this->componentContext->AddDeleteAction(
            $rawData["ID"],
            $rawData["DELETE_LINK"],
            CIBlock::GetArrayByID($rawData["IBLOCK_ID"], "ELEMENT_DELETE"),
            ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]
        );
    }

    /**
     * Returns current item of $arResult with null check
     *
     * @return ArrayElement|null
     */
    private function getCurrentElement(): ArrayElement|null
    {
        return $this->currentSection ?? $this->currentLink ?? $this->currentItem;
    }

    /**
     * Returns key ITEMS of $arResult or itself otherwise
     *
     * @return array
     */
    private function getArrayResultWithNullCheck(): array
    {
        return $this->data[self::DEFAULT_ITEMS_KEY] ?? $this->data ?? [];
    }

    /**
     * @return void
     */
    private function resetIndex(): void
    {
        $this->index = 0;
    }

    /**
     * @return void
     */
    private function incrementIndex(): void
    {
        $this->index++;
    }

    /**
     * @param  array|null  $data
     * @param  string      $class
     *
     * @return ArrayElement|null
     */
    private function processLoop(?array $data, string $class): ?ArrayElement
    {
        if ($data == null) {
            $this->resetIndex();

            return null;
        }

        $instance = null;

        if ($class == ArrayItem::class) {
            $instance = new ArrayItemImpl($data);
            $this->currentItem = $instance;
        }

        if ($class == ArrayLink::class) {
            $instance = new ArrayLinkImpl($data);
            $this->currentLink = $instance;
        }

        if ($class == ArraySection::class) {
            $instance = new ArraySectionImpl($data);
            $this->currentSection = $instance;
        }


        $this->addBitrixEditActionsIfComponentContextExists();
        $this->incrementIndex();

        return $instance;
    }

}
