<?php use \Bitrix\Main\Localization\Loc; ?>
<div class="row">
    <?php
    foreach ($arResult['ITEMS'] as $index => $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="col-12">
        <div class="b-section-item b-section-item--bighalf b-section-item--biggest" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="b-section-item__picture">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <?php if ($arResult['USE_LAZY_LOAD']): ?>
                        <img src="<?=$arResult['EMPTY_IMAGE_SRC']?>" data-src="<?=CFile::GetPath($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0])?>" class="is-lazy-img" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
                    <?php else: ?>
                        <img src="<?=CFile::GetPath($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0])?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
                    <?php endif; ?>
                </a>
            </div>
            <div class="b-section-item__body">
                <div class="b-section-item__meta">
                    <?php if ($arItem['PROPERTIES']['author']['VALUE']): ?>
                        <div class="b-meta-item">
                            <span class="fa fa-user"></span>
                            <?php
                                echo $arItem['PROPERTIES']['author']['VALUE'];
                            ?>
                        </div>
                    <?php elseif ($arItem['PROPERTIES']['LINK_SOURCE']['VALUE']): ?>
                        <div class="b-meta-item">
                            <span class="fa fa-user"></span> <?=$arItem['PROPERTIES']['LINK_SOURCE']['VALUE']?>
                        </div>
                    <?php endif; ?>
                    <?php if ($arParams['DISPLAY_DATE'] == 'Y' && !empty($arItem['DISPLAY_ACTIVE_FROM'])): ?>
                    <div class="b-meta-item">
                        <span class="fa fa-clock-o"></span> <span><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <h3 class="b-section-item__title">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><?=$arItem['NAME']?></a>
                </h3>
                <div class="b-section-item__desc">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
                <div class="b-section-item__btns">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-primary"><?=Loc::getMessage('RS_NL_DETAIL_BTN');?></a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
