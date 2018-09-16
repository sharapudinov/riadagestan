<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$arResult["SEARCH"] = array();
$arItemIds = array();

$arItem = null;
foreach($arResult["CATEGORIES"] as $nCategoryId => $arCategory) {
  	foreach($arCategory["ITEMS"] as $i => $arItem) {
    		if(isset($arItem["ITEM_ID"]) && $arItem['MODULE_ID'] == 'iblock') {
            $arResult["SEARCH"][$arItem["ITEM_ID"]] = &$arResult["CATEGORIES"][$nCategoryId]["ITEMS"][$i];
            $arItemIds[] = $arItem['ITEM_ID'];
        }
  	}
}
$arResult['ALL_RESULTS'] = $arItem;


if (count($arItemIds) > 0 && \Bitrix\Main\Loader::includeModule('iblock')) {
    $arPictureIds = array();
    $itemsIterator = \Bitrix\Iblock\ElementTable::getList([
        'filter' => [
            'ID' => $arItemIds
        ],
        'select' => [
            'ID',
            'ACTIVE_FROM',
            'NAME',
            'PREVIEW_PICTURE'
        ]
    ]);
    while ($arItem = $itemsIterator->fetch()) {
        $nItemId = $arItem['ID'];

        if (!empty($arItem['PREVIEW_PICTURE'])) {
            $arPictureIds[$nItemId] = $arItem['PREVIEW_PICTURE'];
        }

        if (isset($arResult["SEARCH"][$nItemId])) {
            $arResult['SEARCH'][$nItemId]['DATE'] = $arItem['ACTIVE_FROM'];
        }
    }

    $uploadDir = \Bitrix\Main\Config\Option::get('main', 'upload_dir', 'upload');
    $filesIterator = \Bitrix\Main\FileTable::getList([
        'filter' => [
            'ID' => array_values($arPictureIds)
        ],
    ]);
    while($arFile = $filesIterator->fetch()) {
        $nItemId = array_search($arFile['ID'], $arPictureIds);
        $arFile['SRC'] = '/'.$uploadDir.'/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];

        if (isset($arResult["SEARCH"][$nItemId])) {
            $arResult['SEARCH'][$nItemId]['PICTURE'] = $arFile;
        }
    }


}
