<?php
    /**
     * Created by PhpStorm.
     * User: Asus-
     * Date: 11.01.2015
     * Time: 23:38
     */

    $APPLICATION->SetAdditionalCSS('/js/fancybox/jquery.fancybox.css');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/responsiveslides.min.js');
    $APPLICATION->AddHeadScript("https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU");
    $APPLICATION->AddHeadScript("https://storage.googleapis.com/vrview/2.0/build/vrview.min.js");
    $file = CFile::ResizeImageGet(
        $arResult["PROPERTIES"]["IMAGES"]["VALUE"][0],
        array(
            'height' => 600,
            'width'  => 600,
            BX_RESIZE_IMAGE_PROPORTIONAL
        )
    );
AddMessage2Log($file);
    $APPLICATION->AddViewContent(
        'shared_image_path',
        "https://" . $_SERVER['SERVER_NAME'] . $file['src']
    );

?>



