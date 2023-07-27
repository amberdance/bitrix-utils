<?php

namespace Hard2Code\Util;


use CBitrixComponentTemplate;
use Hard2Code\Entity\Handler\EntityHandler;
use Hard2Code\Entity\Handler\EntityHandlerImpl;
use Hard2Code\Entity\Link\ArrayLink;
use Hard2Code\Entity\Section\ArraySection;

/**
 * Helper class for getting instance of entity handler
 * Not to confuse entities with the bitrix info block entities
 */
final class Entities
{

    private static ?EntityHandler $instance = null;

    /**
     * Returns raw $arResult["ITEMS"] for classic foreach handling items
     *
     * @param  array  $arResult
     *
     * @return array
     */
    public static function getItems(array $arResult): array
    {
        self::getHandler($arResult);

        return self::$instance->getItems();
    }

    /**
     *
     * @param  array  $arResult
     *
     * @return ArrayLink[]
     */
    public static function getLinks(array $arResult): array
    {
        self::getHandler($arResult);
        $links = [];

        while ($link = self::$instance->nextLink()) {
            $links[] = $link;
        }

        return $links;
    }

    /**
     * @param  array                          $arResult
     * @param  CBitrixComponentTemplate|null  $context
     *
     * @return ArraySection[]
     */
    public static function getSections(array $arResult, ?CBitrixComponentTemplate $context = null): array
    {
        $handler = self::getHandler($arResult);
        $sections = [];

        if ($context != null) {
            $handler->setComponentContext($context);
        }

        while ($section = $handler->nextSection()) {
            $sections[] = $section;
        }

        return $sections;
    }

    /**
     * Returns handler-wrapper of bitrix $arResult array
     *
     * @param  array  $arResult
     *
     * @return EntityHandler
     */
    public static function getHandler(array $arResult): EntityHandler
    {
        if (self::isArrayResultEquals($arResult)) {
            return self::$instance;
        }

        self::$instance = new EntityHandlerImpl($arResult);

        return self::$instance;
    }

    public static function getHandlerWithComponentContext(
        array $arResult,
        CBitrixComponentTemplate $context
    ): EntityHandler {
        $handler = self::getHandler($arResult);
        $handler->setComponentContext($context);

        return $handler;
    }

    /**
     * @param  array  $arResult
     *
     * @return bool
     */
    private static function isArrayResultEquals(array $arResult): bool
    {
        return (self::$instance != null && Arrays::equals(self::$instance->getArrayResult(), $arResult));
    }

}
