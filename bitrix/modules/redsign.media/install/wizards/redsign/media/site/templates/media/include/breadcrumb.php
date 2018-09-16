<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (isset($APPLICATION)) {    
    return $APPLICATION->GetNavChain(
        $path = false,
        $iNumFrom = 0,
        $sNavChainPath = SITE_TEMPLATE_PATH.'/components/bitrix/breadcrumb/media/template.php',
        $bIncludeOnce = true,
        $bShowIcons = false
    );
} else {
    return '';
}