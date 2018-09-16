<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

if (!Loader::includeModule('iblock') || !Loader::includeModule('redsign.devfunc')) {
    return;
}

Loc::loadMessages(__FILE__);
