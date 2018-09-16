<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Loader;

if (Loader::includeModule('iblock') && count($arResult['ITEMS']) > 0) {
    $arUserIds = [];
    foreach ($arResult['ITEMS'] as $arItem) {
        if (isset($arItem['ELEMENT']['CREATED_BY']) && !in_array($arItem['ELEMENT']['CREATED_BY'], $arUserIds)) {
            $arUserIds[] = $arItem['ELEMENT']['CREATED_BY'];
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
