<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Config\Option;


$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$protocol = $request->isHttps() ? 'https://' : 'http://';
$host = $request->getHttpHost();

$sUrl = $protocol.$host;

$sOrganizationName = Option::get('redsign.media', 'microdata_organization_name');
$sOrganizationAdress = Option::get('redsign.media', 'microdata_organization_adress');
$sOrganizationTelephone = Option::get('redsign.media', 'microdata_organization_telephone');
$sLogoPath = Option::get('redsign.media', 'microdata_organization_logo_path', SITE_DIR.'include/header/logo.png');
?>
<link itemprop="url" href="<?=$sUrl?>">
<meta itemprop="name" content="<?=$sOrganizationName?>">
<meta itemprop="address" content="<?=$sOrganizationAdress?>">
<meta itemprop="telephone" content="<?=$sOrganizationTelephone?>">
<div itemprop="logo" itemscope="" itemtype="http://schema.org/ImageObject">
    <link itemprop="url contentUrl" href="<?=$sUrl.$sLogoPath?>">
</div>
