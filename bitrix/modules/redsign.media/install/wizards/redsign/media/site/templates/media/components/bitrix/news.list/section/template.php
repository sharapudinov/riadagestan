<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Localization\Loc;

$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/lazy/jquery.lazy.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.ui.js');

$this->setFrameMode(true);

$nCurrentPage = (isset($arResult['NAV_RESULT']->NavPageNomer) ? $arResult['NAV_RESULT']->NavPageNomer : 1);

$arBlockIds = array(
  'itemsBlockId' => $arResult['SECTION_BLOCK_ID'],
  'loadMoreBlockId' => $arResult['SECTION_BLOCK_ID'].'_loadmore',
  'ajaxNavBlockId' => $arResult['SECTION_BLOCK_ID'].'_ajaxnav',
);

$arJsAjaxParams = array(
    'itemsBlockId' => $arBlockIds['itemsBlockId'],
    'loadMoreBlockId' => $arBlockIds['loadMoreBlockId'],
    'ajaxNavBlockId' => $arBlockIds['ajaxNavBlockId'],
    'itemSelector' => '.b-section-item',
    'useCache' => true,
    'data' => array(
      'action' => 'navigation',
      'id' => $arResult['SECTION_BLOCK_ID']
    )
);

$arJsAjaxNavigation = array_merge($arJsAjaxParams, array(
    'callbacks' => array(
        'before' => array('RS.Handlers.startSectionLoading'),
        'success'=> array(
            'RS.Handlers.replaceSectionItems',
            'RS.Handlers.showSectionItems',
            'RS.Handlers.updateSectionNavigation'
        ),
        'after'=> array('RS.Handlers.stopSectionLoading')
    )
));

$arResult['JS_PARAMS_LOAD_MORE'] = array_merge($arJsAjaxParams, array(
    'callbacks' => array(
        'before' => array('RS.Handlers.startSectionLoading'),
        'success'=> array(
            'RS.Handlers.appendSectionItems',
            'RS.Handlers.showSectionItems',
            'RS.Handlers.updateSectionNavigation'
        ),
        'after'=> array('RS.Handlers.stopSectionLoading')
    )
));

$templateData['content'] = array();

if (count($arResult['ITEMS']) > 0):
?>
<section class="l-section">
    <?php if ($arParams['RS_SHOW_SECTION_HEAD'] == 'Y'): ?>
    <div class="l-section__head">
        <h2 class="l-section__title"><?=$arResult['TITLE']?></h2>
        <?php if (false || $arParams["DISPLAY_TOP_PAGER"] == 'Y'): ?>
            <div class="l-section__controls">
                <?php if ($arParams["DISPLAY_TOP_PAGER"] == 'Y'): ?>
                <div class="c-arrows" id="<?=$arBlockIds['ajaxNavBlockId']?>">
                    <?php ob_start(); ?>

                    <?php if ($arResult['PREV_PAGE_LINK']): ?>
                    <a href="<?=$arResult['PREV_PAGE_LINK']?>" class="c-arrows__left" data-ajax-load='<?=Bitrix\Main\Web\Json::encode($arJsAjaxNavigation)?>'></a>
                    <?php else: ?>
                    <a class="c-arrows__left is-disabled"></a>
                    <?php endif; ?>

                    <?php if ($arResult['NEXT_PAGE_LINK']): ?>
                    <a href="<?=$arResult['NEXT_PAGE_LINK']?>" class="c-arrows__right" data-ajax-load='<?=Bitrix\Main\Web\Json::encode($arJsAjaxNavigation)?>'></a>
                    <?php else: ?>
                    <a class="c-arrows__right is-disabled"></a>
                    <?php endif; ?>

                    <?php $templateData['content']['ajaxNavigation'] = ob_get_flush(); ?>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="l-section__items" id="<?=$arBlockIds['itemsBlockId']?>">
        <?php
        ob_start();

        $sFilePath = $_SERVER['DOCUMENT_ROOT'].$templateFolder."/templates/".$arParams['RS_TEMPLATE'].".php";
        if (file_exists($sFilePath)) {
            include($sFilePath);
        } else {
            include($_SERVER['DOCUMENT_ROOT'].$templateFolder."/templates/standart.php");
        }

        $templateData['content']['items'] = ob_get_flush();
        ?>
    </div>

    <?php if($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?php if ($arParams['RS_SHOW_LOAD_MORE_BUTTON'] == 'Y'): ?>
        <div class="l-section__more">
            <?php ob_start(); ?>
                <?php if (isset($arResult['NEXT_PAGE_LINK'])): ?>
                    <a<?php
                      ?> href="<?=$arResult['NEXT_PAGE_LINK']?>"<?php
                      ?> id="<?=$arBlockIds['loadMoreBlockId']?>"<?
                      ?> class="btn btn-lg btn-outline-secondary btn-block"<?php
                      if ($arParams['RS_USE_INFINITE_SCROLL'] == 'Y') {
                          ?> data-infinite-scroll<?php
                      }
                      ?> data-ajax-load='<?=Bitrix\Main\Web\Json::encode($arResult['JS_PARAMS_LOAD_MORE'])?>'>
                        <span><?=Loc::getMessage('RS_NL_SHOW_LOAD_MORE_BUTTON')?></span>
                    </a>
                    <?php $templateData['content']['loadMore'] = ob_get_flush(); ?>
                <?php elseif ($arResult['NAV_RESULT']->NavPageNomer  <=  $arResult['NAV_RESULT']->NavPageCount): ?>
                    <a href="" class="btn btn-lg btn-outline-secondary btn-block disabled"><?=Loc::getMessage('RS_NL_NO_MORE_NEWS')?></a>
                <?php $templateData['content']['loadMore'] = ob_get_clean(); ?>
                <?php else: ?>
                    <?php $templateData['content']['loadMore'] = ob_get_flush(); ?>
                <?php endif; ?>
        </div>
        <?php else: ?>
            <?php
            ob_start();
            echo $arResult["NAV_STRING"];
            $templateData['standartNavigation'] = ob_get_flush();
            ?>
        <?php endif; ?>
    <?php endif; ?>

    <div class="l-section__loader"><div class="spinner"></div></div>
</section>
<?php endif;
