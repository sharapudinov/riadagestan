<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Loader;
if (count($arResult['ITEMS'] > 0) && Loader::includeModule('iblock')) {
    $arSectionIds = [];
    $arSections = [];

    foreach ($arResult['ITEMS'] as $arItem) {
        if (
            !empty($arItem['IBLOCK_SECTION_ID']) &&
            !in_array($arItem['IBLOCK_SECTION_ID'], $arSectionIds)
        ) {
            $arSectionIds[] = $arItem['IBLOCK_SECTION_ID'];
        }
    }

    if (count($arSectionIds) > 0) {
        $resSections = CIBlockSection::GetList(
            [],
            ['ID' => $arSectionIds, 'IBLOCK_ID' => $arParams['IBLOCK_ID']],
            false,
            ['ID', 'NAME', 'SECTION_PAGE_URL', 'UF_SECTION_COLOR'],
            false
        );

        while ($arSection = $resSections->GetNext()) {
            if (!array_key_exists($arSection['ID'], $arSections)) {
              $arSections[$arSection['ID']] = $arSection;
            }
        }
        unset($resSections);
    }

    $arResult['SECTIONS'] = $arSections;

    unset($arSectionIds);
    unset($arSections);
}

$arResult['VIEW_TYPE'] = 'type1';
