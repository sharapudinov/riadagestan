<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true); ?>
<div class="news_item1">

    <h4><?= $arResult["DATE_ACTIVE_FROM"] ?></h4>

    <h1> <?= $arResult["NAME"] ?></h1>

    <!-- Item Author -->
    <?
    if ($arResult["PROPERTIES"]["author"]["VALUE"] != "") {
        ?>
        <span class="itemAuthor">
						<b>Автор:</b> &nbsp;<?= $arResult["PROPERTIES"]["author"]["VALUE"] ?>
					</span>
    <?
    }
    ?>&nbsp;&nbsp;&nbsp;
    <?
    if ($arResult["PROPERTIES"]["foto_author"]["VALUE"] != "") {
        ?>
        <span class="itemAuthor">
						<b>Фото:</b> &nbsp;<?= $arResult["PROPERTIES"]["foto_author"]["VALUE"] ?>
					</span>
    <?
    }
    ?>

    <?
    if ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null || $arResult["PROPERTIES"]["VIDEO"]["VALUE"] != "") {
        $imageinfo = getimagesize($_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]));
        ?>
        <div class="pikachoose" style="float:left; width:800px">
            <div class="mimages">
                <?
                if ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null) {
                    if (count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]) == 1) {

                        $result_image_big = "/upload/fotonews/result_image_big" . $arResult['ID'] . ".png";
                        $dc_result_image1 = $_SERVER["DOCUMENT_ROOT"] . $result_image_big;
                        if (!file_exists($dc_result_image1)) {

                            CFile::ResizeImageFile(
                                $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]),
                                $dc_result_image1,
                                array(),
                                BX_RESIZE_IMAGE_PROPORTIONAL,
                                array(
                                    "type" => "image",
                                    "file" => $_SERVER["DOCUMENT_ROOT"] . "/upload/big_water2.png",
                                    "size" => "real",
                                    "alpha_level" => 100, // 0 - 100
                                    "position" => "br",
                                    "fill" => 'repeat', // resize | repeat
                                )
                            );
                        } elseif (file_exists($dc_result_image1)) {
                            $result_image_big = "/upload/fotonews/result_image_big" . $arResult['ID'] . ".png";
                        }
                        $result_image_small = "/upload/fotonews/result_image_small" . $arResult['ID'] . ".png";
                        $dc_result_image2 = $_SERVER["DOCUMENT_ROOT"] . $result_image_small;
                        if (!file_exists($dc_result_image2)) {

                            CFile::ResizeImageFile(
                                $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]),
                                $dc_result_image2,
                                array('width' => 340, 'height' => 255),
                                BX_RESIZE_IMAGE_EXACT,
                                array(
                                    "type" => "image",
                                    "file" => "",
                                    "size" => "real",
                                    "alpha_level" => 100, // 0 - 100
                                    "position" => "br",
                                    "fill" => 'repeat', // resize | repeat
                                )
                            );
                        } elseif (file_exists($dc_result_image2)) {
                            $result_image_small = "/upload/fotonews/result_image_small" . $arResult['ID'] . ".png";
                        }
                        ?>
                        <a class="fancybox" href="<?= $result_image_big; ?>" data-fancybox-group="gallery"><img
                                class="preview_picture" border="0" src="<?= $result_image_small; ?>" width="340"
                                height="255"/></a>
                    <?
                    } else {
                        ?>
                        <div class="slider slider3">
                            <div class="sliderContent">
                                <?
                                for ($ii = 0; $ii < count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]); $ii++) {


                                    //формируем водяной знак на анонсных и на основных картинках
                                    $result_image_big = "/upload/fotonews/result_image_big$ii" . $arResult['ID'] . ".png";
                                    $dc_result_image1 = $_SERVER["DOCUMENT_ROOT"] . $result_image_big;
                                    if (!file_exists($dc_result_image1)) {

                                        CFile::ResizeImageFile(
                                            $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]),
                                            $dc_result_image1,
                                            array(),
                                            BX_RESIZE_IMAGE_PROPORTIONAL,
                                            array(
                                                "type" => "image",
                                                "file" => $_SERVER["DOCUMENT_ROOT"] . "/upload/big_water2.png",
                                                "size" => "real",
                                                "alpha_level" => 100, // 0 - 100
                                                "position" => "br",
                                                "fill" => 'repeat', // resize | repeat
                                            )
                                        );
                                    } elseif (file_exists($dc_result_image1)) {
                                        $result_image_big = "/upload/fotonews/result_image_big$ii" . $arResult['ID'] . ".png";
                                    }
                                    $result_image_small = "/upload/fotonews/result_image_small$ii" . $arResult['ID'] . ".png";
                                    $dc_result_image2 = $_SERVER["DOCUMENT_ROOT"] . $result_image_small;
                                    if (!file_exists($dc_result_image2)) {

                                        CFile::ResizeImageFile(
                                            $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]),
                                            $dc_result_image2,
                                            array('width' => 340, 'height' => 255),
                                            BX_RESIZE_IMAGE_EXACT,
                                            array(
                                                "type" => "image",
                                                "file" => "",
                                                "size" => "real",
                                                "alpha_level" => 100, // 0 - 100
                                                "position" => "br",
                                                "fill" => 'repeat', // resize | repeat
                                            )
                                        );
                                    } elseif (file_exists($dc_result_image2)) {
                                        $result_image_small = "/upload/fotonews/result_image_small$ii" . $arResult['ID'] . ".png";
                                    }
                                    ?>
                                    <div class="item" style="float:left; margin:10px 20px 10px 0px">
                                        <a class="fancybox" href="<?= $result_image_big; ?>"
                                           data-fancybox-group="gallery"><img class="preview_picture" border="0"
                                                                              src="<?= $result_image_small; ?>"
                                                                              width="340" height="255"/></a>
                                    </div>
                                <?
                                }
                                ?>
                            </div>
                        </div>
                    <?
                    }?>
                <?
                }?>
            </div>

        </div>
    <?
    }
    ?>
    <div class="text" id="qaz">
        <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"]): ?>
            <p><?= $arResult["FIELDS"]["PREVIEW_TEXT"];
                unset($arResult["FIELDS"]["PREVIEW_TEXT"]); ?></p>
        <? endif; ?>
        <? if ($arResult["NAV_RESULT"]): ?>
            <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><br/><? endif; ?>
            <? echo $arResult["NAV_TEXT"]; ?>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br/><?= $arResult["NAV_STRING"] ?><? endif; ?>
        <? elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
            <? echo $arResult["DETAIL_TEXT"]; ?>
        <? else: ?>
            <? echo $arResult["PREVIEW_TEXT"]; ?>
        <? endif ?>

    </div>

</div>
