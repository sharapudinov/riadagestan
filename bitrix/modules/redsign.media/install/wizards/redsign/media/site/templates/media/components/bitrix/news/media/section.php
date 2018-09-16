<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE' => 'Y',
    'GLOBAL_ACTIVE' => 'Y',
);
if (0 < intval($arResult['VARIABLES']['SECTION_ID'])) {
    $arFilter['ID'] = $arResult['VARIABLES']['SECTION_ID'];
} elseif ('' != $arResult['VARIABLES']['SECTION_CODE']) {
    $arFilter['=CODE'] = $arResult['VARIABLES']['SECTION_CODE'];
}

$arCurSection = array();
$arParentSection = array();
$obCache = \Bitrix\Main\Data\Cache::createInstance();
if ($obCache->initCache(36000, serialize($arFilter), '/iblock/catalog')) {

    $arCurSection = $obCache->getVars();

} elseif ($obCache->startDataCache()) {
    if (Loader::includeModule('iblock')) {

        if (defined('BX_COMP_MANAGED_CACHE')) {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache('/iblock/catalog');
        }

        $rsCurSection = CIBlockSection::GetList(array(), $arFilter, false, array('ID', 'IBLOCK_SECTION_ID', 'DESCRIPTION'));
        $arCurSection = $rsCurSection->GetNext();

        if (defined('BX_COMP_MANAGED_CACHE')) {
            $CACHE_MANAGER->RegisterTag('iblock_id_'.$arParams['IBLOCK_ID']);
            $CACHE_MANAGER->EndTagCache();
        }

        $obCache->endDataCache($arCurSection);
    }
}

$template = 'big';

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->get('isAjax') && $request->get('action') == 'mm') {
    $template = 'mm';
    $arParams['NEWS_COUNT'] = 5;
}


$APPLICATION->SetPageProperty('disable-wrapper', 'Y');
$APPLICATION->SetPageProperty('sidebar-path', SITE_DIR.'/include/articles/section_sidebar.php');

if ($arParams['RS_LIST_POPULAR_IS_SHOW'] == 'Y') {
    include $_SERVER['DOCUMENT_ROOT'].$templateFolder.'/include/popular.php';
}
?>
<div class="l-page has-container has-sidebar">
    <div class="l-page__row sticky-content">
        <div class="l-page__main">
            <div class="l-page__content">
                <div class="l-section l-section--attached">
                    <?php
                    $APPLICATION->AddBufferContent(function () use  ($APPLICATION) {
                        return include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/breadcrumb.php';
                    });
                    ?>
                    <h1 class="page-title"><?=$APPLICATION->ShowTitle(true)?></h1>
                    <?php
                    if (isset($arCurSection['DESCRIPTION'])) {
                      echo $arCurSection['DESCRIPTION'];
                    }
                    ?>
                </div>
                <?php $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "section",
                    Array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                        "SORT_BY1" => $arParams["SORT_BY1"],
                        "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                        "SORT_BY2" => $arParams["SORT_BY2"],
                        "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                        "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                        "SET_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "MESSAGE_404" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "FILE_404" => $arParams["FILE_404"],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
                        "ADD_SECTIONS_CHAIN" => 'N',
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                        "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                        "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                        "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                        "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                        "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                        "CHECK_DATES" => $arParams["CHECK_DATES"],
                        "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                        "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                        "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                        "RS_SHOW_SECTION_HEAD" => 'N',
                        "RS_TEMPLATE" => $template,
                        "RS_SHOW_LOAD_MORE_BUTTON" => "Y",
                        "RS_USE_INFINITE_SCROLL" => "Y"
                    ),
                    $component
                ); ?>
            </div>
        </div>
        <aside class="l-page__sidebar">
            <?php $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "section",
                Array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NEWS_COUNT" => 5,
                    "SORT_BY1" => "SHOW_COUNTER",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => $arParams["SORT_BY2"],
                    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                    "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                    "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                    "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                    "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                    "CHECK_DATES" => $arParams["CHECK_DATES"],
                    "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                    "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                    "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                    "RS_SHOW_SECTION_HEAD" => 'Y',
                    "RS_TEMPLATE" => 'slim',
                    "RS_BLOCK_TITLE" => Loc::getMessage('RS_N_POPULAR_IN_SECTION'),
                    "RS_SHOW_LOAD_MORE_BUTTON" => "N",
                    "RS_USE_INFINITE_SCROLL" => "N",
                    "RS_NOT_SELECT_FIRST_ITEM" => "Y"
                ),
                $component
            ); ?>
            <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/sidebar.php'; ?>
        </aside>
    </div>
</div>
