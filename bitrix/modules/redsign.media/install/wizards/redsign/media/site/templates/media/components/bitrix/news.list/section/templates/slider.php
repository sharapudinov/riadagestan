<?php
$arSliderOptions = array(
    'items' => 3,
    'responsive' => array(
      '0' => array(
        'items' => 1
      ),
      '480' => array(
        'items' => 2
      ),
      '576' => array(
        'items' => 3
      )
    )
);
?>

<div class="owl owl-carousel" data-slider="true" data-slider-options='<?=\Bitrix\Main\Web\Json::encode($arSliderOptions)?>'>
    <?php
    foreach ($arResult['ITEMS'] as $index => $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
        <div class="b-section-item b-section-item--simple" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="b-section-item__picture">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <?php if ($arResult['USE_LAZY_LOAD']): ?>
                    <img src="<?=$arResult['EMPTY_IMAGE_SRC']?>" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="is-lazy-img" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
                    <?php else: ?>
                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
                    <?php endif; ?>
                </a>
            </div>
            <div class="b-section-item__body">
                <div class="b-section-item__meta">
                    <?php if ($arParams['DISPLAY_DATE'] == 'Y' && !empty($arItem['DISPLAY_ACTIVE_FROM'])): ?>
                    <div class="b-meta-item">
                        <span class="fa fa-clock-o"></span> <span><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <h3 class="b-section-item__title">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><?=$arItem['NAME']?></a>
                </h3>
            </div>
        </div>
    <?php endforeach; ?>
</div>
