<?php
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/vendor/slideout/slideout.js');
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/mobile_nav.js');
?>
<div id="mobile-nav" class="l-mobile-nav">
    <div class="l-mobile-nav__container">
        <div class="l-mobile-nav__close js-mobile-nav-close">
            <div class="l-mobile-nav__close-icon"></div>
        </div>
        <div class="l-mobile-nav__menu">
            <?php
            $sMobileMenuFile = $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/footer/mobile_menu.php';
            if (file_exists($sMobileMenuFile)) {
                include $sMobileMenuFile;
            }
            ?>
        </div>
        <div class="l-mobile-nav__search">
            <?php $APPLICATION->ShowViewContent('rs_mobile_search'); ?>
        </div>
    </div>
</div>
