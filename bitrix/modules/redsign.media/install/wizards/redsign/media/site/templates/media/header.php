<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Page\Asset;

if (!Loader::includeModule('redsign.media')) {
    die();
}

// get site data
$cacheTime = 86400;
$cacheId = 'CSiteGetByID'.SITE_ID;
$cacheDir = '/siteData/'.SITE_ID.'/';

$cache = Bitrix\Main\Data\Cache::createInstance();
if ($cache->initCache($cacheTime, $cacheId, $cacheDir)) {
    $arSiteData = $cache->getVars();
} elseif ($cache->startDataCache()) {

    $arSiteData = array();

    $rsSites = CSite::GetByID(SITE_ID);
    if ($arSite = $rsSites->Fetch()) {
        $arSiteData['SITE_NAME'] = $arSite['SITE_NAME'];
    }

    if (empty($arSiteData)) {
        $cache->abortDataCache();
    }

    $cache->endDataCache($arSiteData);
}

$curPage = $APPLICATION->GetCurPage(true);

/* Add assets */
CJSCore::Init(array('ajax', 'ls'));
$asset = Asset::getInstance();
$asset->addString('<link href="'.CHTTP::URN2URI('/favicon.ico').'" rel="shortcut icon"  type="image/x-icon">');
$asset->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
$asset->addString('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">');

$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/jquery/jquery-3.2.1.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/jquery/jquery.mousewheel.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/jquery/jquery.jalc.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/jquery/jquery.viewportchecker.js');

$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/OwlCarousel/owl.carousel.js');

$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/ResizeSensor/ResizeSensor.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/stickyfill/stickyfill.js');

$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/slider.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/main.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/custom.js');
$asset->addJs(SITE_DIR.'/assets/js/custom.js');

$asset->addCss(SITE_TEMPLATE_PATH.'/assets/css/main.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/css/custom.css');
$asset->addCss(SITE_DIR.'/assets/css/custom.css');

$asset->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/mCustomScrollbar/jquery.mCustomScrollbar.js');
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/vendor/mCustomScrollbar/jquery.mCustomScrollbar.css');
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" itemscope itemtype="http://schema.org/WebSite">
<head>
    <?php $APPLICATION->IncludeFile(SITE_DIR."include/template/head_start.php",array(),array("MODE"=>"html"))?>

    <?$APPLICATION->ShowHead();?>
    <title>
    <?php
    $APPLICATION->ShowTitle();
    if (
        $curPage != SITE_DIR.'index.php' &&
        $arSiteData['SITE_NAME'] != ''
    ) {
        echo ' | '. $arSiteData['SITE_NAME'];
    }
    ?>
    </title>
    <?$APPLICATION->IncludeFile(SITE_DIR."include/template/head_end.php",array(),array("MODE"=>"html"))?>
</head>
<body>
    <div id="svg-icons" style="display: none"></div>
    <div class="wrapper" id="wrapper">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/template/body_start.php",array(),array("MODE"=>"html"))?>
        <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
        <?$APPLICATION->IncludeFile(SITE_DIR."include/adv/before_header.php",array(),array("MODE"=>"html"))?>
        <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/headers/light.php'; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/topbar.php'; ?>

        <?php
        $APPLICATION->AddBufferContent(function () use ($APPLICATION) {
            $returnString = '';

            $isDisableWrapper = $APPLICATION->GetProperty('disable-wrapper') == 'Y';
            $isDisableContainer = $APPLICATION->GetProperty('disable-container') == 'Y';
            $isDisableSidebar = $APPLICATION->GetProperty('disable-sidebar') == 'Y';
            $isDisableSection = $APPLICATION->GetProperty('disable-section') == 'Y';


            if (!$isDisableWrapper):
                $sPageClasses = '';
                $sPageRowClasses = '';

                if (!$isDisableContainer) {
                    $sPageClasses .= ' has-container';
                }

                if (!$isDisableSidebar) {
                    $sPageClasses .= ' has-sidebar';
                    $sPageRowClasses .= ' sticky-content';
                }

                $returnString .= '<div class="l-page'.$sPageClasses.'">';
                    $returnString .= '<div class="l-page__row'.$sPageRowClasses.'">';
                        $returnString .= '<div class="l-page__main">';

                        if (!$isDisableSection)  {
                            $returnString .= '<div class="l-section">';

                            $returnString .= include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/breadcrumb.php';

                            $returnString .= '<h1 class="page-title">'.$APPLICATION->GetTitle(true).'</h1>';
                        }
            endif;

            return $returnString;
        });
        ?>
