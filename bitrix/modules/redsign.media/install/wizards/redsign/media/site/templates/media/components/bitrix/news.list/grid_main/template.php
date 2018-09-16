<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

$this->setFrameMode(true);

$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/lazy/jquery.lazy.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.ui.js');

if (count($arResult['ITEMS']) > 0):
?>
<div class="l-grid-main l-grid-main--<?=$arResult['VIEW_TYPE']?> js-lazyload-section is-wait-loading">
    <div class="l-grid-main__container container js-lazyload-section__container">
        <?php
        foreach ($arResult['ITEMS'] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="b-main-grid-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="b-main-grid-item__bg is-lazy" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"></div>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="b-main-grid-item__link"></a>
            <div class="b-main-grid-item__overlay">
                <?php
                if (isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])):
                    $sSectionColor = ($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['UF_SECTION_COLOR'] ? $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['UF_SECTION_COLOR'] : false);
                ?>
                <h6 class="b-main-grid-item__cat"<?php if ($sSectionColor) { echo ' style="background-color: '.$sSectionColor.'; border-color: '.$sSectionColor.';"';} ?>>
                    <a href="<?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['SECTION_PAGE_URL']?>"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></a>
                </h6>
                <?php endif; ?>

                <div class="b-main-grid-item__content">
                    <?php if ($arParams['DISPLAY_DATE'] == 'Y'): ?>
                    <div class="b-main-grid-item__date"><span class="fa fa-clock-o"></span> <span><?=$arItem['DISPLAY_ACTIVE_FROM']?></span></div>
                    <?php endif; ?>
                    <h2  class="b-main-grid-item__title"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME'];?></a></h2>
                    <div class="b-main-grid-item__desc"><?=$arItem['PREVIEW_TEXT'];?></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="l-grid-main__preload js-lazyload-section__preload"><div class="spinner"></div></div>
</div>
<?php endif;
