<?php

use Hard2Code\Util\Entities;

protectBitrixPrologInclude();

if (empty($arResult["ITEMS"])) {
    return;
}

$handler = Entities::getHandlerWithComponentContext($arResult, $this);
$renderer = $handler->getHtmlRenderer();
?>

<div class="news">
    <div class="container">
        <div class="posts_list row">
            <?php while ($item = $handler->nextItem()) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12" <?= $item->getBitrixEditAreaId() ?>>
                    <div class="post">
                        <?php $renderer->showBackgroundImageWithLink(400, 300) ?>
                        <div class="content">
                            <?php $renderer->showPostedDateAsString()->showDetailLinkURL() ?>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>

        <div class="archive_link">
            <a href="<?= $handler->getArchiveLink() ?>"><span>Все новости</span><i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
