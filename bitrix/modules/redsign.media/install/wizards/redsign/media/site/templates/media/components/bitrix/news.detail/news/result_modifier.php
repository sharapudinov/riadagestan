<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Loader;
use \Redsign\Media\TextUtils;

// Get author
if (isset($arResult['CREATED_BY'])) {
    $resUsers = CUser::GetList(
        ($by = "id"), ($order = "desc"),
        array('ID' => $arResult['CREATED_BY']),
        array(
            'FIELDS' => array('ID', 'LOGIN', 'NAME', 'LAST_NAME', 'PERSONAL_PHOTO')
        )
    );

    $arUser = $resUsers->GetNext();
    if ($arUser) {
        if (isset($arUser['PERSONAL_PHOTO'])) {
            $arUser['AVATAR'] = CFile::GetPath($arUser['PERSONAL_PHOTO']);
        }

        $arResult['AUTHOR'] = $arUser;
    }
}

// Get Reading time
if (Loader::includeModule('redsign.media')) {
    $arResult['READING_TIME'] = TextUtils::getReadingTime($arResult['DETAIL_TEXT']);
}

// Siblings elements
$rsElements = CIBlockElement::GetList(
    array(
        $arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
        $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
    ),
    array(
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'ACTIVE' => 'Y',
        'CHECK_PERMISSIONS' => 'Y',
        'SECTION_ID' => $arResult['IBLOCK_SECTION_ID']
    ),
    false,
    array(
        "nPageSize" => 1,
        "nElementID" => $arResult["ID"],
    ),
    array(
        'ID',
        'NAME',
        'ACTIVE_DATE_FROM',
        'SORT',
        'DETAIL_PAGE_URL',
        'PREVIEW_PICTURE'
    )
);
$rsElements->SetUrlTemplates($arParams["DETAIL_URL"]);


$arItems = array();
while ($arElement = $rsElements->GetNext()) {
    if ($arElement['ID'] != $arResult['ID']) {
        $arElement['PREVIEW_PICTURE'] = CFile::GetFileArray($arElement['PREVIEW_PICTURE']);
    }

    $arItems[] = $arElement;
}

if ($arParams['RS_USE_ELEMENT_NAVIGATION'] == 'Y') {
    $arResult['PREVIOUS_ELEMENT'] = null;
    $arResult['NEXT_ELEMENT'] = null;

    if (count($arItems) === 3) {
        $arResult['PREVIOUS_ELEMENT'] = $arItems[0];
        $arResult['NEXT_ELEMENT'] = $arItems[2];
    } elseif(count($arItems) === 2) {
        if ($arItems[0]['ID'] == $arResult['ID']) {
            $arResult['NEXT_ELEMENT'] = $arItems[1];
        } else {
            $arResult['PREVIOUS_ELEMENT'] = $arItems[0];
        }
    }
}

// Tags
$arResult['TAGS_ARRAY'] = [];
if (!empty($arResult['TAGS'])) {
	$arTags = array_map('trim', explode(',', $arResult['TAGS']));

	foreach ($arTags as $sTag) {
		$sTagTranslit = CUtil::translit($sTag, "ru");

		$arr = $arResult['TAGS_ARRAY'][] = [
			'NAME' => $sTag,
			'LINK' => SITE_DIR.'search/?q='.urlencode($sTag)
		];
	}
}

// share content
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$protocol = $request->isHttps() ? 'https://' : 'http://';
$host = $request->getHttpHost();

$arResult['RS_SHARE_CONTENT'] = array();
$arResult['RS_SHARE_CONTENT']['title'] = $arResult['NAME'];
$arResult['RS_SHARE_CONTENT']['url'] = $protocol.$host.$arResult['DETAIL_PAGE_URL'];
if (isset($arResult['PREVIEW_PICTURE'])) {
    $arResult['RS_SHARE_CONTENT']['image'] = $protocol.$host.$arResult['PREVIEW_PICTURE']['SRC'];
}
if (isset($arResult['PREVIEW_TEXT'])) {
    $arResult['RS_SHARE_CONTENT']['description'] = $arResult['PREVIEW_TEXT'];
}

$this->__component->SetResultCacheKeys(array('RS_SHARE_CONTENT'));

// ADV
ob_start();
if (file_exists($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/adv/detail_1.php')) {
	include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/adv/detail_1.php';
}
$adv = ob_get_clean();

if (strlen($arResult['DETAIL_TEXT']) > 0) {
	$arResult['DETAIL_TEXT'] = str_replace("#ADV_1#", $adv, $arResult['DETAIL_TEXT']);
}

// Empty image
$arResult['EMPTY_IMAGE_SRC'] = SITE_TEMPLATE_PATH.'/assets/images/empty_1600_1200.png';
