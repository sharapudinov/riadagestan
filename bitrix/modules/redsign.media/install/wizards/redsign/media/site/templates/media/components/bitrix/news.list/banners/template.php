<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$this->addExternalJs('https://cdnjs.cloudflare.com/ajax/libs/jarallax/1.9.2/jarallax.min.js');

if (count($arResult['ITEMS']) > 0):
    $arTemplateViews = array('view1', 'slider');
    $sCurrentView = (in_array($arParams['RS_TEMPLATE_VIEW'], $arTemplateViews) ? $arParams['RS_TEMPLATE_VIEW']: reset($arTemplateViews));

    $isBackground = $arParams['RS_SET_BACKGROUND'] == 'Y';

    $sSectionLayoutClasses = 'l-section-banners l-section-banners--'.$sCurrentView.' js-lazyload-section is-wait-loading';
    $sSectionItemClasses = 'b-banner-item b-banner-item--'.$sCurrentView;
    if ($isBackground) {
        $sSectionLayoutClasses .= ' has-bg';
    }

    if ($sCurrentView == 'slider') {
      $arSliderOptions = array(
          'items' => 3,
          'responsive' => array(
            '0' => array(
              'items' => 1
            ),
            '550' => array(
              'items' => 2
            ),
            '1024' => array(
              'items' => 3
            )
          )
      );
    }
?>
<div class="<?=$sSectionLayoutClasses?>">
    <div class="container l-section-banners__container js-lazyload-section__container">
        <div class="l-section-banners__items<?php if($sCurrentView == 'slider'): ?>owl owl-carousel<?php endif; ?>"<?php if($sCurrentView == 'slider'): ?> data-slider="true" data-slider-options='<?=\Bitrix\Main\Web\Json::encode($arSliderOptions)?>'<?php endif; ?>>
            <?php
            foreach ($arResult['ITEMS'] as $index => $arItem):
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="<?=$sSectionItemClasses?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="b-banner-item__link"></a>
                <?php if (isset($arItem['PREVIEW_PICTURE']['SRC'])):?>
                <div class="b-banner-item__bg is-lazy" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"></div>
                <?php endif; ?>
                <div class="b-banner-item__overlay">
                    <div class="b-banner-item__content">
                        <?php if ($arParams['DISPLAY_DATE'] == 'Y'): ?>
                        <div class="b-banner-item__date"><span class="fa fa-clock-o"></span> <span><?=$arItem['DISPLAY_ACTIVE_FROM']?></span></div>
                        <?php endif; ?>
                        <h2  class="b-banner-item__title"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME'];?></a></h2>
                        <div class="b-banner-item__desc"><?=$arItem['PREVIEW_TEXT'];?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if ($isBackground && !empty($arParams['RS_TEMPLATE_BG_IMAGE'])): ?>
    <div class="l-section-banners__bg is-lazy<?php if ($arParams['RS_TEMPLATE_BG_IMAGE_IS_PARALLAX'] == 'Y'): ?> js-lazyload-section__parallax<?php endif; ?>" data-src="<?=$arParams['RS_TEMPLATE_BG_IMAGE']?>"></div>
    <?php endif; ?>
    <div class="l-section-banners__preload js-lazyload-section__preload">
        <div class="spinner"></div>
    </div>
</div>
<?php endif;
