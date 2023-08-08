<?php

protectBitrixPrologInclude();

use Hard2Code\Util\Entities;
use Hard2Code\Util\Iblocks;
use Hard2Code\Util\Links;

if (empty($arResult["SECTIONS"])) {
    return;
}

$handler = Entities::getHandlerWithComponentContext($arResult, $this);
$currentSection = $handler->get("section");
$heading = Iblocks::getName($arParams["IBLOCK_ID"]);
$sectionDescription = $currentSection['DESCRIPTION'];
?>

<div class="container">
    <div class="heading"><?= $heading ?></div>

    <?php if ($sectionDescription) : ?>
        <div class="section_description">
            <?= $sectionDescription ?>
        </div>
    <?php endif ?>

    <div class="section_wrapper row g-1">
        <?php while ($section = $handler->nextSection()) : ?>
            <?php
            $sectionCode = $section->getCode();
            $link = preg_match("/files|upload|http/", $sectionCode)
                ? $sectionCode
                : $section->getSectionPageUrl();
            ?>

            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="section_item" <?= $section->getBitrixEditAreaId() ?>>
                    <a href="<?= $link ?>" <?= Links::getTargetAttribute($sectionCode) ?>><?= $section->getName() ?></a>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>
