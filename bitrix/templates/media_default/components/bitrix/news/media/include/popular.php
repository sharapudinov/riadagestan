<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

$arPopularNewsParams = array(
    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
    "ADD_SECTIONS_CHAIN" => "N",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "N",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
    "CACHE_TIME" => $arParams['CACHE_TIME'],
    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
    "CHECK_DATES" => $arParams["CHECK_DATES"],
    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
    "DISPLAY_BOTTOM_PAGER" => "N",
    "DISPLAY_DATE" => $arParams['DISPLAY_DATE'],
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "FIELD_CODE" => array(),
    "FILTER_NAME" => "",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "INCLUDE_SUBSECTIONS" => "Y",
    "MESSAGE_404" => "",
    "NEWS_COUNT" => "3",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
    "PAGER_TITLE" => "",
    "PARENT_SECTION" => "",
    "PARENT_SECTION_CODE" => "",
    "PREVIEW_TRUNCATE_LEN" => "300",
    "PROPERTY_CODE" => array(),
    "SET_BROWSER_TITLE" => "N",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "N",
    "SET_META_KEYWORDS" => "N",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "N",
    "SHOW_404" => "N",
    "SORT_BY1" => $arParams['RS_LIST_POPULAR_SORT_BY1'],
    "SORT_BY2" => $arParams['RS_LIST_POPULAR_SORT_BY2'],
    "SORT_ORDER1" => $arParams['RS_LIST_POPULAR_SORT_ORDER1'],
    "SORT_ORDER2" => $arParams['RS_LIST_POPULAR_SORT_ORDER2'],
    "STRICT_SECTION_CHECK" => "Y",
    "TEMPLATE_THEME" => "blue",
    "MEDIA_PROPERTY" => "",
    "SLIDER_PROPERTY" => "",
    "SEARCH_PAGE" => '',
    "USE_RATING" => "N",
    "USE_SHARE" => "N",
    "RS_SET_BACKGROUND" => "N",
    "RS_TEMPLATE_VIEW" => "slider"
);
if (
    $arParams['RS_LIST_POPULAR_MODE'] == 'RS_LIST_POPULAR_MODE_2' ||
    $arParams['RS_LIST_POPULAR_MODE'] == 'RS_LIST_POPULAR_MODE_4'
) {
    $arPopularNewsParams["PARENT_SECTION"] = $arResult["VARIABLES"]["SECTION_ID"];
    $arPopularNewsParams["PARENT_SECTION_CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
}

if (
    $arParams['RS_LIST_POPULAR_MODE'] == 'RS_LIST_POPULAR_MODE_3' ||
    $arParams['RS_LIST_POPULAR_MODE'] == 'RS_LIST_POPULAR_MODE_4'
) {
    global $arMediaFeaturedFilter;
    $arPopularNewsParams["FILTER_NAME"] = 'arMediaFeaturedFilter';
}

$APPLICATION->IncludeComponent("bitrix:news.list", "banners", array(
	
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);
