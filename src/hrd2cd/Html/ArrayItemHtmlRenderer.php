<?php

namespace Hard2Code\Html;


use Hard2Code\Entity\Handler\EntityHandler;
use Hard2Code\Entity\Item\ArrayItem;
use Hard2Code\Util\Arrays;
use Hard2Code\Util\Formatters;
use Hard2Code\Util\Images;
use Hard2Code\Util\Links;

final class ArrayItemHtmlRenderer implements HtmlRenderer
{

    private static ?ArrayItemHtmlRenderer $instance = null;

    private EntityHandler $handler;

    private function __construct(EntityHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param  EntityHandler  $handler
     *
     * @return HtmlRenderer
     */
    public static function of(EntityHandler $handler): HtmlRenderer
    {
        if (self::$instance == null || !Arrays::equals($handler->getItems(), self::$instance->handler->getItems())) {
            self::$instance = new ArrayItemHtmlRenderer($handler);
        }

        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public function showBackgroundImageWithDiv(
        int $width = Images::DEFAULT_WIDTH,
        int $height = Images::DEFAULT_HEIGHT,
        bool $isProportional = true
    ): HtmlRenderer {
        $imageMeta = $this->getImageMeta($width, $height, $isProportional);

        if (!$imageMeta["SRC"]) {
            return $this;
        }

        $template = "<div class={$imageMeta['wrapper_class_name']}>";
        $template .= "<div class={$imageMeta['image_class_name']} style={$imageMeta['bg_attribute']}></div>";
        $template .= "</div>";

        echo $template;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function showBackgroundImageWithLink(
        int $width = Images::DEFAULT_WIDTH,
        int $height = Images::DEFAULT_HEIGHT,
        bool $isProportional = true
    ): HtmlRenderer {
        $imageMeta = $this->getImageMeta($width, $height, $isProportional);

        if (!$imageMeta["SRC"]) {
            return $this;
        }

        $link = $this->getCurrentElement()->getDetailPageUrl();
        $openWindowAttribute = Links::getTargetAttribute($link);

        $template = "<div class={$imageMeta['wrapper_class_name']}>";
        $template .= "<a href='$link' class={$imageMeta['image_class_name']} style={$imageMeta['bg_attribute']}  $openWindowAttribute></a>";
        $template .= "</div>";

        echo $template;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showBackgroundImageWithCustomLink(
        string $link,
        int $width = Images::DEFAULT_WIDTH,
        int $height = Images::DEFAULT_HEIGHT,
        bool $isProportional = true
    ): HtmlRenderer {
        $imageMeta = $this->getImageMeta($width, $height, $isProportional);

        if (!$imageMeta["SRC"]) {
            return $this;
        }

        $openWindowAttribute = Links::getTargetAttribute($link);

        echo "<a href='$link' class={$imageMeta['image_class_name']}  style={$imageMeta['bg_attribute']} $openWindowAttribute></a>";

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showDetailLinkUrl(
        ?string $className = self::DEFAULT_LINK_CLASSNAME
    ): HtmlRenderer {
        $element = $this->getCurrentElement();
        $link = $element->getDetailPageUrl();
        $name = $element->getName();
        $attribute = Links::getTargetAttribute($element->getDetailPageUrl());

        echo "<a href='$link' class=$className $attribute>$name</a>";

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showPostedDateAsString(
        ?string $className = self::DEFAULT_POSTED_DATE_CLASSNAME
    ): HtmlRenderer {
        $date = $this->parseDateTime();
        $formattedDate = $date["DD"]." ".ToLower(GetMessage("MONTH_".intval($date["MM"])."_S"))." ".$date["YYYY"];

        echo "<div class='$className'><span>$formattedDate</span><i class='far fa-calendar-alt'></i></div>";

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showPostedDateAsDigits(
        ?string $className = self::DEFAULT_POSTED_DATE_CLASSNAME
    ): HtmlRenderer {
        $date = $this->parseDateTime();
        $formattedDate = "{$date["DD"]}.{$date['MM']}.{$date['YYYY']}";

        echo "<div class='$className'><span>$formattedDate</span><i class='far fa-calendar-alt'></i></div>";

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showPreviewText(
        ?string $className = self::DEFAULT_PREVIEW_TEXT_CLASSNAME,
        int $truncateLength = 0
    ): HtmlRenderer {
        echo $this->processShowPreviewText($truncateLength, false, $className,);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showRawPreviewText(
        ?string $className = self::DEFAULT_PREVIEW_TEXT_CLASSNAME,
        int $truncateLength = 0
    ): HtmlRenderer {
        echo $this->processShowPreviewText($truncateLength, true, $className);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showTitle(string $className = self::DEFAULT_TITLE_CLASSNAME): HtmlRenderer
    {
        $element = $this->getCurrentElement();
        $content = $element->getName();

        echo "<div class='$className'>$content</div>";

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function showTitleWithPreviewText(string $className = self::DEFAULT_TITLE_CLASSNAME): HtmlRenderer
    {
        $element = $this->getCurrentElement();
        $content = $element->getName().strip_tags($element->getPreviewText());

        echo "<div class='$className'>$content</div>";

        return $this;
    }

    /**
     * @param  int   $width
     * @param  int   $height
     * @param  bool  $isProportional
     *
     * @return array
     */
    private function getImageMeta(int $width, int $height, bool $isProportional): array
    {
        $element = $this->getCurrentElement();
        $imageId = $element->getValue("PREVIEW_PICTURE")["ID"] ?? $element->getValue("DETAIL_PICTURE")["ID"];
        $image = Images::getResizedImage($imageId, $isProportional, $width, $height);

        return array_merge($image->getRawData(), [
            "bg_attribute"       => Images::getBackgroundImageStyleAttribute($image->getSource()),
            "wrapper_class_name" => self::DEFAULT_WRAPPER_CLASSNAME,
            "image_class_name"   => $image->getHeight() >= 1080
                ? self::DEFAULT_IMAGE_CLASSNAME." contain"
                : self::DEFAULT_IMAGE_CLASSNAME,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function showPostedDate(
        string $format = Formatters::DEFAULT_DATE_FORMAT,
        string $className = HtmlRenderer::DEFAULT_POSTED_DATE_CLASSNAME
    ): HtmlRenderer {
        $date = $this->getCurrentElement()->getDate();

        echo "<div class='$className'><span>".Formatters::formatDateWithBitrixFormatter(strtotime($date),
                $format)."</span><i class='far fa-calendar-alt'></i></div>";

        return $this;
    }

    /**
     * @return ArrayItem
     */
    private function getCurrentElement(): ArrayItem
    {
        return $this->handler->getItem();
    }

    /**
     * @return array
     */
    private function parseDateTime(): array
    {
        $element = $this->getCurrentElement();

        return ParseDateTime($element->getDate());
    }

    /**
     * @param  int          $truncateLength
     * @param  bool         $stripTags
     *
     * @param  string|null  $className
     *
     * @return string
     */
    private function processShowPreviewText(
        int $truncateLength,
        bool $stripTags,
        ?string $className
    ): string {
        $element = $this->getCurrentElement();
        $previewText = $stripTags ? trim(strip_tags($element->getPreviewText())) : $element->getPreviewText();
        $className = $className ?? self::DEFAULT_PREVIEW_TEXT_CLASSNAME;

        if ($truncateLength > 0) {
            $previewText = TruncateText(HTMLToTxt($previewText), $truncateLength);
        }

        return "<div class='$className'>$previewText</div>";
    }

}
