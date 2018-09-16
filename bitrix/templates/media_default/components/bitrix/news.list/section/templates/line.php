<div class="l-line-widget">
    <?php foreach ($arResult['ITEMS'] as $index => $arItem): ?>
    <a class="b-section-item b-section-item--line" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
        <?php if ($arParams['DISPLAY_DATE'] == 'Y' && !empty($arItem['DISPLAY_ACTIVE_FROM'])): ?>
        <span class="b-section-item__meta">
            <div class="b-meta-item b-meta-item--small">
                <span class="fa fa-clock-o"></span> <span><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
            </div>
        </span>
        <?php endif; ?>
        <span class="b-section-item__title"><?=$arItem['NAME']?></span>
    </a>
    <?php endforeach; ?>
</div>
