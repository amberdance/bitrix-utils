
# Bitrix utils
**This library contains various classes for working with templates, components and the Bitrix API, allowing you to speed up development.**

_The library is intended for use exclusively in conjunction with 1C Bitrix: Site Management_


## Authors

- [@Alexey Fishler](https://github.com/amberdance/)


## Installation

Install my-project with composer

```bash
composer require hard2code/bitrix-utils
```

**Для корректной работы библиотеке от вас требуется наличие интерфейса constant.php в директории `/php_interface/config/constant.php`**
    
## Usage/Examples

```php
<?php

/*----------------------------------------------------*
  Some example of usage ArraySections in template
*----------------------------------------------------*/

use Hard2Code\Util\Entities;
use Hard2Code\Util\Images;

protectBitrixPrologInclude();

if (empty($arResult["SECTIONS"])) {
    return;
}

$sections = Entities::getSections($arResult, $this);
?>


<div class="container">
    <?php foreach ($sections as $i => $section):
        $sectionPageUrl = $section->getSectionPageUrl();
        $picture = Images::getResizedImage($section->getUfProperty("image"), true, 400, 300);
        $name = $section->getName();
        $url = $section->getSectionPageUrl();
        $code = $section->getCode();
        $someProperty = $section->getUfProperty("some_uf_property");
        $description = $section->getDescription();
        ?>

        <?php if ($section->hasDescription()): ?>
          <div class="description"><?= $description ?></div>
        <?php endif ?>

    <?php endforeach; ?>
</div>

```
