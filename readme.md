![Logo](https://avatars.mds.yandex.net/i?id=b680b582b8f5eaea37441d23fbdd9084_l-5221151-images-thumbs&n=13)

# Bitrix utils

**This library contains various classes for working with templates, components, allowing you to speed up development
working with OOP style***.

*_The library is intended for use exclusively in conjunction with 1C Bitrix: Site Management_

### Library purpose:

* encapsulation of work with arrays of the $arResult array coming from Bitrix components
* minimization of the combination of php and html code

**Данная библиотека содержит набор различных вспомогательных классов для работы с компонентами и шаблонами в 1С
Битрикс "Управление сайтом" в ООП стиле***

*_Библиотека предназначенная исключительно для совместного использования с 1С Битрикс "Управление сайтом"._

### Назначение библиотеки:

* инкапсуляция работы с массивами вида $arResult, приходящими из компонентов Битрикса
* минимализация мешанины php и html кода

## Authors

- [@Alexey Fishler](https://github.com/amberdance/)

## Installation

Install my-project with composer

```bash
composer require hard2code/bitrix-utils
```

## Usage/Examples

_See more in examples directory_

_Более подробные примеры находятся в директории examples_

### **Working with sections as OOP style:**
### **Работа с разделами в ООП стиле:**

```php
<?php

/*----------------------------------------------------*
  Some example of usage ArraySection in template
*----------------------------------------------------*/

use Hard2Code\Util\Entities;
use Hard2Code\Util\Images;

protectBitrixPrologInclude();
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

### **Working with links as OOP style:**
### **Работа с ссылками в ООП стиле:**

```php
<?php

/*----------------------------------------------------*
  Some example of usage ArrayLink in template
*----------------------------------------------------*/

use Hard2Code\Util\Entities;
use Hard2Code\Util\Links;

protectBitrixPrologInclude();
?>

<div id="category_menu">
    <div class="container">
        <div class="swiper">
            <div class="swiper-wrapper">

                <?php foreach (Entities::getLinks($arResult) as $link):
                    $src = $link->getSource();
                    $title = $link->getTitle();
                    $isSelected = $link->isSelected();
                    $isAbsolute = $link->isRelative();
                    $isRelative = $link->isAbsolute();
                    ?>

                    <div class="swiper-slide">
                        <div class="category">
                            <a class="category_title" href="<?= $src ?>"
                               target="<?= Links::getTargetAttribute($src) ?>">
                                <div class="title"> <?= $title ?></div>
                            </a>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>
        </div>
    </div>
</div>
```

### **Including assets:**
### **Подключение асетов:**

```php
<?php

use Hard2Code\Util\Assets;

Assets::includeDefaultMeta();
Assets::includeManifest("/assets/site.webmanifest");
Assets::includeJs(
    "/vendor/jquery.min.js",
    "/vendor/swiper-bundle.min.js",
    "/vendor/bootstrap.bundle.min.js",
    "/vendor/validate.min.js",
    "/vendor/fotorama.js",
    "/vendor/fontawesome.js",
);

Assets::includeJs("https://kit.fontawesome.com/90a47ca9b8.js");
Assets::includeJsRecursively("/directory");
Assets::includeCssRecursively("/vendor", "/air2hut");
```

**Список доступных методов вы можете найти в соответствующих интерфейсах:**

* ArraySection
* ArrayItem
* ArrayLink

_При необходимости, вы можете создать свои реализации данных интерфейсов в пользовательском коде_

## Installation

Install my-project with composer

```bash
composer require hard2code/bitrix-utils
```

## Authors

- [@Alexey Fishler](https://github.com/amberdance/)
