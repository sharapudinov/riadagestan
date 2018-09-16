<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

if ($arParams['USE_SHARE'] == 'Y') {
    \Bitrix\Main\Page\Asset::getInstance()->addString('<script src="https://yastatic.net/share2/share.js" charset="utf-8"></script>');
    \Bitrix\Main\Page\Asset::getInstance()->addJs('//yastatic.net/es5-shims/0.0.2/es5-shims.min.js');
}

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addString('<meta property="og:title" content="'.$arResult['RS_SHARE_CONTENT']['title'].'">');
$asset->addString('<meta property="og:url" content="'.$arResult['RS_SHARE_CONTENT']['url'].'">');
$asset->addString('<meta property="og:type" content="article">');

if (isset($arResult['RS_SHARE_CONTENT']['description'])) {
    $asset->addString('<meta property="og:description" content="'.$arResult['RS_SHARE_CONTENT']['description'].'">');
}

if (isset($arResult['RS_SHARE_CONTENT']['image'])) {
    $asset->addString('<meta property="og:image" content="'.$arResult['RS_SHARE_CONTENT']['image'].'">');
}
