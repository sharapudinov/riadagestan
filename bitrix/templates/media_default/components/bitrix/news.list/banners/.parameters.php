<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

foreach (array('iblock', 'redsign.media') as $module) {
    if (!Loader::includeModule($module)) {
        return;
    }
}

$arTemplateParameters['RS_SET_BACKGROUND'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('RS_NL_PARAMETERS_SET_BACKGROUND'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
);

$arTemplateParameters['RS_TEMPLATE_BG_IMAGE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('RS_NL_PARAMETERS_BANNER_BG_IMAGE'),
    'TYPE' => 'STRING',
    'DEFAULT' => ''
);

$arTemplateParameters['RS_TEMPLATE_BG_IMAGE_IS_PARALLAX'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('RS_NL_PARAMETERS_BANNER_BG_IMAGE_IS_PARALLAX'),
    'TYPE' => 'CHECKBOX',
    'DEFAULT' => 'N'
);
