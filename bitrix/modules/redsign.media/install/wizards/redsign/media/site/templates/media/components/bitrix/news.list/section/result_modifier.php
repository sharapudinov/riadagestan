<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;

if (!empty($arParams['PARENT_SECTION']) || !empty($arParams['PARENT_SECTION_CODE'])) {
    $arFilter = [];

    if (!empty($arParams['PARENT_SECTION'])) {
        $arFilter['ID'] = $arParams['PARENT_SECTION'];
    } else {
        $arFilter['CODE'] = $arParams['PARENT_SECTION_CODE'];
    }

    $resSections = CIBlockSection::GetList(
        [],
        $arFilter,
        false,
        ['ID', 'NAME', 'SECTION_PAGE_URL', 'UF_SECTION_COLOR', 'DESCRIPTION'],
        false
    );

    $arSection = $resSections->GetNext();
    if ($arSection) {
        $arResult['PARENT_SECTION'] = $arSection;
        $arResult['TITLE'] = $arSection['NAME'];
    }
}

if (count($arResult['ITEMS']) > 0) {
    if (in_array('CREATED_BY', $arParams['FIELD_CODE'])) {
        $arUserIds = array();

        foreach ($arResult['ITEMS'] as $arItem) {
            if (!in_array($arItem['CREATED_BY'], $arUserIds)) {
                $arUserIds[] = $arItem['CREATED_BY'];
            }
        }


        if (count($arUserIds) > 0) {
            $arUsers = array();
            $arFilter = array(
                'ID' => implode(' | ', $arUserIds)
            );

            $by = "id";
            $order = "desc";
            $resUsers = CUser::GetList($by, $order, $arFilter, array(
                'FIELDS' => array('ID', 'LOGIN', 'NAME', 'LAST_NAME')
            ));

            while($arUser = $resUsers->GetNext()) {
                $arUsers[$arUser['ID']] = $arUser;
            }


            $arResult['USERS'] = $arUsers;
            unset($arUsers);
        }
    }
}

if (!empty($arParams['RS_UNIQ_ID'])) {
    $arResult['SECTION_BLOCK_ID'] = $arParams['RS_UNIQ_ID'];
} else {
    $arUniqData = array(
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'RS_TEMPLATE' => $arParams['RS_TEMPLATE'],
        'USE_LAZY_LOAD' => $arResult['USE_LAZY_LOAD'],
        'EMPTY_IMAGE_SRC' => $arResult['EMPTY_IMAGE_SRC']
    );

    $sUniqData = serialize($arUniqData);
    $arResult['SECTION_BLOCK_ID'] = 'section_'.substr(md5($sUniqData), 0, 7);
}

if ($arParams["DISPLAY_BOTTOM_PAGER"] == 'Y' || $arParams["DISPLAY_TOP_PAGER"] == 'Y') {
    $nCurrentPage = $arResult['NAV_RESULT']->NavPageNomer;
    $nPageCount = $arResult['NAV_RESULT']->NavPageCount;
    $sNavParam =  'PAGEN_'.$arResult['NAV_RESULT']->NavNum;

    $arDelParams = array('clear_cache', 'id', 'isAjax', 'action');

    $request = Application::getInstance()->getContext()->getRequest();
    $uriString = $request->getRequestUri();

    $uri = new Uri($uriString);
    $uri->deleteParams($arDelParams);

    if ($nCurrentPage + 1 <= $nPageCount) {
        $uri->addParams(array(
            $sNavParam => $nCurrentPage + 1
        ));
        $arResult['NEXT_PAGE_LINK'] = $uri->getUri();
    }

    if ($nCurrentPage - 1 > 0) {
        $uri->addParams(array(
            $sNavParam => $nCurrentPage - 1
        ));
        $arResult['PREV_PAGE_LINK'] = $uri->getUri();
    }

    $arResult['NAV_PARAMS'] = array(
        'currentPage' => $nCurrentPage,
        'pageCount' => $nPageCount,
        'navParamNomer' => $sNavParam,
    );
}

$this->__component->SetResultCacheKeys(array('SECTION_BLOCK_ID', 'NAV_PARAMS'));

if (!isset($arParams['RS_SHOW_SECTION_HEAD'])) {
    $arParams['RS_SHOW_SECTION_HEAD'] = 'Y';
}

if (!empty($arParams['RS_BLOCK_TITLE'])) {
    $arResult['TITLE'] = $arParams['RS_BLOCK_TITLE'];
}

if (!isset($arParams['RS_NOT_SELECT_FIRST_ITEM'])) {
    $arParams['RS_NOT_SELECT_FIRST_ITEM'] = 'N';
}

$arResult['USE_LAZY_LOAD'] = true;
$arResult['EMPTY_IMAGE_SRC'] = SITE_TEMPLATE_PATH.'/assets/images/empty_1600_1200.png';
