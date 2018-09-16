<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$arTemplateParameters['RS_USE_CONSENT'] = [
    'PARENT' => 'DETAIL_SETTINGS',
    'NAME' => Loc::getMessage('RS_SE_PARAMETERS_USE_CONSENT'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'Y',
    'REFRESH' => 'Y'
];

if ($arCurrentValues['RS_USE_CONSENT'] == 'Y') {
    $arAgreements = \Bitrix\Main\UserConsent\Agreement::getActiveList();
    $arTemplateParameters['RS_CONSENT_ID'] = [
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => Loc::getMessage('RS_SE_PARAMETERS_CONSENT'),
        'TYPE' => 'LIST',
        'DEFAULT' => '-',
        'VALUES' => $arAgreements
    ];
}
