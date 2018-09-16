<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


if (is_array($arResult['PREVIEW_PICTURE'])) {
    $arFileTmp = CFile::ResizeImageGet(
        $value,
        array("width" => $arParams["DISPLAY_IMG_DETAIL_WIDTH"], "height" => $arParams["DISPLAY_IMG_DETAIL_HEIGHT"]),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );

    $arResult["DETAIL_PICTURE"] = array(
        "SRC" => $arFileTmp["src"],
        "WIDTH" => $arFileTmp["width"],
        "HEIGHT" => $arFileTmp["height"],
    );

}
?>