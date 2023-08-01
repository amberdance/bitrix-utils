<?php

namespace Hard2Code\Html;

use Hard2Code\Util\Images;

interface HtmlRenderer
{
    public const DEFAULT_WRAPPER_CLASSNAME = "image_wrapper";
    public const DEFAULT_IMAGE_CLASSNAME = "image";
    public const DEFAULT_PREVIEW_TEXT_CLASSNAME = "announcement";
    public const DEFAULT_LINK_CLASSNAME = "link";
    public const DEFAULT_POSTED_DATE_CLASSNAME = "posted_date";
    public const DEFAULT_TITLE_CLASSNAME = "title";

    /**
     * Renders preview text with div with user html content as it is
     *
     * @param  string|null  $className
     * @param  int          $truncateLength
     *
     * @return HtmlRenderer
     */
    public function showPreviewText(
        ?string $className = HtmlRenderer::DEFAULT_PREVIEW_TEXT_CLASSNAME,
        int $truncateLength = -1
    ): HtmlRenderer;

    /**
     * Renders preview text without any html tags
     *
     * @param  string|null  $className
     * @param  int          $truncateLength
     *
     * @return HtmlRenderer
     */
    public function showRawPreviewText(
        ?string $className = HtmlRenderer::DEFAULT_PREVIEW_TEXT_CLASSNAME,
        int $truncateLength = -1
    ): HtmlRenderer;

    /**
     * Renders posted date width div and formatted date as string like a
     * 28.02.2023
     *
     * @param  string|null  $className
     *
     * @return HtmlRenderer
     */
    public function showPostedDateAsDigits(?string $className = HtmlRenderer::DEFAULT_POSTED_DATE_CLASSNAME
    ): HtmlRenderer;

    /**
     * Renders posted date width div and formatted date as string like a 28 feb
     * 2023
     *
     * @param  string|null  $className
     *
     * @return HtmlRenderer
     */
    public function showPostedDateAsString(
        ?string $className = HtmlRenderer::DEFAULT_POSTED_DATE_CLASSNAME
    ): HtmlRenderer;

    /**
     * Renders detail page url with tag 'a'
     *
     * @param  string|null  $className
     *
     * @return ArrayItemHtmlRenderer
     */
    public function showDetailLinkUrl(?string $className = HtmlRenderer::DEFAULT_LINK_CLASSNAME): HtmlRenderer;

    /**
     * Renders detail url with passed link to create tag "a"
     *
     * @param  string  $link
     * @param  int     $width
     * @param  int     $height
     * @param  bool    $isProportional
     *
     * @return HtmlRenderer
     */
    public function showBackgroundImageWithCustomLink(
        string $link,
        int $width = Images::DEFAULT_WIDTH,
        int $height = Images::DEFAULT_HEIGHT,
        bool $isProportional = true
    ): HtmlRenderer;

    /**
     * Renders tag 'a' with style='background-image(url)'
     *
     * @param  int   $width
     * @param  int   $height
     * @param  bool  $isProportional
     *
     * @return HtmlRenderer
     */
    public function showBackgroundImageWithLink(
        int $width = Images::DEFAULT_WIDTH,
        int $height = Images::DEFAULT_HEIGHT,
        bool $isProportional = true
    ): HtmlRenderer;

    /**
     * Renders tag 'div' with style='background-image(url)'
     *
     * @param  int   $width
     * @param  int   $height
     * @param  bool  $isProportional
     *
     * @return HtmlRenderer
     */
    public function showBackgroundImageWithDiv(
        int $width = Images::DEFAULT_WIDTH,
        int $height = Images::DEFAULT_HEIGHT,
        bool $isProportional = true
    ): HtmlRenderer;


    /**
     * @param  string  $className
     *
     * @return HtmlRenderer
     */
    public function showTitleWithPreviewText(string $className = self::DEFAULT_TITLE_CLASSNAME): HtmlRenderer;
}
