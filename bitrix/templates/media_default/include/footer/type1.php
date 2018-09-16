<footer class="l-footer">
    <div class="container">
        <div class="card bg-dark card-footer">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    ".default",
                                    array(
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR.'include/footer/logo.php',
                                        "EDIT_TEMPLATE" => ""
                                    ),
                                    false
                                );?>
                            </div>
                            <div class="col-12 col-md">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    ".default",
                                    array(
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR.'include/footer/desc.php',
                                        "EDIT_TEMPLATE" => ""
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="b-footer-widget__socials">
                            <?php
                            $sSocnetLinks = $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/footer/socnet_links.php';
                            if (file_exists($sMenuFile)) {
                                include $sSocnetLinks;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="l-footer__bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR.'include/footer/copyright.php',
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    );?>
                </div>
                <div class="col-auto">Powered by <a href="https://redsign.ru" target="__blank">ALFA Systems</a></div>
            </div>
        </div>
    </div>
</footer>
