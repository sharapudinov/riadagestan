<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

if ($arResult["PAGE_URL"]): ?>
<ul class="b-share-social">
<?php
if (is_array($arResult["BOOKMARKS"]) && count($arResult["BOOKMARKS"]) > 0):
  	foreach(array_reverse($arResult["BOOKMARKS"]) as $name => $arBookmark):
  		  ?><li class="b-share-social__item"><?=$arBookmark["ICON"]?></li><?
  	endforeach;
endif;
?>
</ul>
<?php else: ?>
    <?=Loc::getMessage("SHARE_ERROR_EMPTY_SERVER");?>
<?php endif;
