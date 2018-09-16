<div id="sticky-header" class="sticky-header">
    <header class="l-head-light" >
        <div class="l-head-light__container">
            <div class="l-head-light__logo">
                <a class="b-head-logo" href="<?=SITE_DIR?>">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR.'include/header/logo.php',
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );?>
                </a>
            </div>
            <div class="l-head-light__mobile-menu js-mobile-menu-open"><a class="c-hamburger-icon js-mobile-nav-open" href="#"><span></span></a></div>
            <div class="l-head-light__menu">
                <?php
                $sMenuFile = $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/header/menu.php';
                if (file_exists($sMenuFile)) {
                    include $sMenuFile;
                }
                ?>
            </div>
            <div class="l-head-light__components">
                <?php
                $sSocnetLinks = $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/header/socnet_links.php';
                if (file_exists($sMenuFile)) {
                    include $sSocnetLinks;
                }
                ?>
                <a class="c-component-item js-sa-toggle" href="#">
                    <span class="fa fa-navicon" aria-hidden="true"></span>
                </a>
                <a class="c-component-item js-search-reveal" href="#">
                    <span class="fa fa-search" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </header>
</div>
