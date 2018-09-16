<?php foreach ($arResult['ITEMS'] as $index => $arItem): ?>
<div class="b-mm-catalog-item">
    <?php if (is_array($arItem['PREVIEW_PICTURE'])): ?>
    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="b-mm-catalog-item__thumbnail">
        <img src="<?=CFile::GetPath($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0])?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>">
    </a>
    <?php endif; ?>
    <h3><a class="b-mm-catalog-item__title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
    <?php if ($arParams['DISPLAY_DATE'] == 'Y' && !empty($arItem['DISPLAY_ACTIVE_FROM'])): ?>
    <span class="b-mm-catalog-item__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
    <?php endif; ?>
</div>
<?php endforeach; ?>