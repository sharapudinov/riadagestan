<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

if(!empty($arResult["SEARCH"])):
?>
<div class="title-search-result l-title-search-result">
    <?php //\Bitrix\Main\Diag\Debug::dump($arResult['SEARCH']); ?>
    <?php foreach($arResult["SEARCH"] as $arItem): ?>
    <div id="b-title-search-item" class="b-title-search-item">
        <div class="b-title-search-item__thumb">
            <?php if (isset($arItem['PICTURE'])): ?>
                <img src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>">
            <?php endif; ?>
        </div>
        <div class="b-title-search-item__body">
            <h3><a href="<?echo $arItem["URL"]?>" class="b-title-search-item__name"><?=$arItem["NAME"]?></a></h3>
            <?php if (isset($arItem['DATE'])): ?>
            <div class="b-title-search-item__date">
                <span class="fa fa-clock-o"></span> <span><?=$arItem['DATE']?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    <a href="<?=$arResult['ALL_RESULTS']['URL']?>" class="btn btn-primary btn-block"><?=$arResult['ALL_RESULTS']['NAME']?></a>
</div>
<?php else: ?>
    <div class="title-search-result l-title-search-result">
        <div class="text-center"><?=Loc::getMessage('RS_ST_ITEMS_NOT_FOUND')?></div>
    </div>
<?php
endif;
