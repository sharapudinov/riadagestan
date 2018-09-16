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

$arTemplateParameters['RS_TEMPLATE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE'),
    'TYPE' => 'LIST',
    'VALUES' => array(
        'standart' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_STANDART'),
        'wide' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_WIDE'),
        'slim' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_SLIM'),
        'big' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_BIG'),
        'slider' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_SLIDER'),
        '2columns' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_2COLUMNS'),
        'line' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_TEMPLATE_LINE'),
    ),
    'DEFAULT' => 'standart'
);

$arTemplateParameters['RS_BLOCK_TITLE'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_BLOCK_TITLE'),
    'TYPE' => 'STRING',
    'DEFAULT' => ''
);

$arTemplateParameters['RS_UNIQ_ID'] = array(
    'PARENT' => 'BASE',
    'NAME' => Loc::getMessage('RS_NL_SECTION_PARAMETERS_UNIQ_ID'),
    'TYPE' => 'STRING',
    'DEFAULT' => 'section_'.randString(7)
);
