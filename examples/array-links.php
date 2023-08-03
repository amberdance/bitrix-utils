<?php

/** @var ArrayElement|ArrayLink $link */

use Hard2Code\Entity\ArrayElement;
use Hard2Code\Entity\Link\ArrayLink;
use Hard2Code\Util\Entities;
use Hard2Code\Util\Links;

protectBitrixPrologInclude();

if (empty($arResult)) {
    return;
}
?>

<div class="links">
    <?php foreach (Entities::getLinks($arResult) as $link): ?>
        <?php
        $src = $link->getSource();
        $name = $link->getName();
        ?>

        <a href="<?= $src ?>" class="item" <?= Links::getTargetAttribute($src) ?>><?= $name ?></a>
    <?php endforeach ?>
</div>
