<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

if (!empty($arResult)):
?>
<ul class="b-topbar-menu">
    <?php
    foreach($arResult as $arItem):   ?>
    <li class="b-topbar-menu__item">
        <a href="<?=$arItem['LINK']?>" class="b-topbar-menu__link"><?=$arItem['TEXT']?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif;
