<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

// 
// if (\Bitrix\Main\Loader::includeModule('iblock') && count($arResult) > 0) {
//
//     $cache = \Bitrix\Main\Data\Cache::createInstance();
//
//     $arPictureIds = array();
//     $arCatalogItems = array();
//
//     if ($cache->initCache(7200, "cache_key")) {
//         $arResult = $cache->getVars();
//     } elseif($cache->startDataCache()) {
//         $arOrder = array('ACTIVE_FROM' => "ASC", 'CREATED_DATE' => 'ASC');
//         $arFilter = array('ACTIVE' => 'Y', 'INCLUDE_SUBSECTIONS' => 'Y');
//         $arSelect = array('ID', 'NAME', 'FROM_ACTIVE', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL');
//         $arNavStartParams = array('nTopCount' => 5);
//
//         foreach ($arResult as &$arMenuItem) {
//             if (isset($arMenuItem['PARAMS']['FROM_IBLOCK']) && isset($arMenuItem['PARAMS']['SECTION_ID'])) {
//                 $arMenuItems['ARTICLES'] = array();
//                 $arFilter['SECTION_ID'] = $arMenuItem['PARAMS']['SECTION_ID'];
//                 $rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, $arNavStartParams, $arSelect);
//
//                 while ($arItem = $rsItems->GetNext()) {
//                     $arMenuItem['ARTICLES'][$arItem['ID']] = $arItem;
//
//                     if (!empty($arItem['PREVIEW_PICTURE'])) {
//                         $arPictureIds[$arItem['PREVIEW_PICTURE']] = $arItem['ID'];
//                         $arCatalogItems[$arItem['ID']] = &$arMenuItem['ARTICLES'][$arItem['ID']];
//                     }
//                 }
//             }
//         }
//
//         if (count($arPictureIds) > 0) {
//             $uploadDir = \Bitrix\Main\Config\Option::get('main', 'upload_dir', 'upload');
//
//             $filesIterator = \Bitrix\Main\FileTable::getList(array(
//                 'filter' => array(
//                     'ID' => array_keys($arPictureIds)
//                 ),
//                 'cache' => array(
//                     'ttl' => 3600,
//                 )
//             ));
//
//             while($arFile = $filesIterator->fetch()) {
//                 if (isset($arPictureIds[$arFile['ID']])) {
//                     $iItemId = $arPictureIds[$arFile['ID']];
//                     if (isset($arCatalogItems[$iItemId])) {
//                         $arFile['SRC'] = '/'.$uploadDir.'/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];
//                         $arCatalogItems[$iItemId]['PICTURE'] = $arFile;
//                     }
//                 }
//             }
//         }
//
//         unset($arCatalogItems);
//         unset($arMenuItem);
//
//         $cache->endDataCache($arResult);
//     }
// }
