<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
 IncludeTemplateLangFile(__FILE__); ?>

<script type="text/javascript">
    // Set up PhotoSwipe with all anchor tags in the Gallery container 
    document.addEventListener('DOMContentLoaded', function () {
        Code.photoSwipe('a', '#Gallery');
    }, false);
</script>


<?
$date = get_date($arResult["DISPLAY_ACTIVE_FROM"]);
?>

<div class='box'>
    <div class="m_news_open">
        <h1><?= $arResult["NAME"] ?></h1>

        <div class="m_news_info">
            <span
                class="itemDateCreated"><?= $date["day"] ?> <?= $date["month"] ?> <?= $date["year"] ?> <?= $date["time"] ?></span>
			<span class="itemCategory">
				<span><?= GetMessage("posted_in") ?>:&nbsp;&nbsp;</span><a
                    href="<? echo($arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"]) ?>"><? echo $arResult["SECTION"]["PATH"][0]["NAME"] ?></a>
                <? if ($arResult["SECTION"]["PATH"][1]["NAME"] != null): ?>
                    &nbsp;-&nbsp;<a
                        href="<? echo($arResult["SECTION"]["PATH"][1]["SECTION_PAGE_URL"]) ?>"><? echo $arResult["SECTION"]["PATH"][1]["NAME"] ?></a>
                <? endif; ?>
			</span>

            <?
            if ($arResult["PROPERTIES"]["LINK_SOURCE"]["VALUE"] != "") {
                ?>
                <span class="itemCategory">
				<span><?= GetMessage("source") ?>: &nbsp;</span><?= $arResult["PROPERTIES"]["LINK_SOURCE"]["VALUE"] ?>
			</span>
            <? } ?>

        </div>



        <?
        if ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null) {
            ?>
            <div class="box1">
                <div id="Gallery">
                    <div class="gallery-row box1">
                        <div class="fotorep_vnt1">

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
                                            "file" => "", // $_SERVER["DOCUMENT_ROOT"]."/upload/mini_water.png",
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

                                <?if ($ii == 1): ?>
                                    <div style="display:none;">
                                <? endif; ?>

                                <div class="gallery-item">
                                    <a href="<?= $result_image_big; ?>"><img src="<?= $result_image_big; ?>"/></a>
                                </div>

                                <?if (($ii + 1) == count($arResult["PROPERTIES"]["IMAGES"]["VALUE"])): ?>
                                    </div>
                                <? endif; ?>


                                <?
                                //break;
                            }
                            ?>
                        </div>
                        <!-- end fotorep_vnt1 -->
                    </div>
                    <!-- end gallery-row box -->
                </div>
                <!-- end Gallery -->

            </div><!-- end box -->
        <? } ?>



        <p>
            <? echo $arResult["DETAIL_TEXT"]; ?>
        </p>
    </div>
    <div class="pager_bottom">
        <ul class="box_pager">
            <? if ($arResult["PROPERTIES"]["author"]["VALUE"] != "") { ?>
                <li>
                    <?= GetMessage("author") ?>: &nbsp;<?= $arResult["PROPERTIES"]["author"]["VALUE"] ?>
                </li>
            <? } ?>
            <? if ($arResult["PROPERTIES"]["on_of_views"]["VALUE"] == 1): ?>

                <li>
                    <?= GetMessage("total_views") ?>:
                    <b>
                        <?$frame = $this->createFrame('area', false)->begin('загрузка');?>
                        <? if ($arResult["SHOW_COUNTER"] != null): ?>
                            <?= $arResult["SHOW_COUNTER"]; ?>
                        <? else: ?>
                            1
                        <? endif ?>
                        <? $frame->end(); ?>

                    </b>
                </li>
            <? endif; ?>
        </ul>
    </div>

</div>

<div class="box">
    <? $arThemes = $arResult['PROPERTIES']['THEME']['VALUE'];

    if (is_array($arThemes))
        $GLOBALS["arrFilterTheme"] = array("PROPERTY_THEME" => $arThemes, "!ID" => $arResult["ID"]);
    elseif (CModule::IncludeModule('iblock')) {
        $dbSection = CIBlockElement::GetElementGroups($arResult['ID'], true, array("ID"));
        $arSection = $dbSection->getNext();
        $GLOBALS["arrFilterTheme"] = array("SECTION_ID" => $arSection["ID"], "!ID" => $arResult["ID"]);
    }

    ?>
    <?
    if(SITE_ID=='s1') {
        $iblock_id=2;
        $iblock_type="news";
    }
    if(SITE_ID=='s2') {
        $iblock_id='16';
        $iblock_type="news_en";
    }
    $component->arResult["LIST_SUB_NEWS"] = $APPLICATION->IncludeComponent("bitrix:news.list", "main_theme_news", array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "Y",
        "IBLOCK_TYPE" =>$iblock_type,
        "IBLOCK_ID" => $iblock_id,
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "arrFilterTheme",
        "FIELD_CODE" => "",
        "PROPERTY_CODE" => "",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "�������",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y"
    ),
        $component,
        array(
            "ACTIVE_COMPONENT" => "Y"
        )
    ); ?>
</div>
<script type="text/javascript">
    // Initialize the plugin with no custom options
    $(document).ready(function () {
        // I just set some of the options
        $("#makeMeScrollable").smoothDivScroll({
            touchScrolling: true,
            manualContinuousScrolling: false,
            hotSpotScrolling: false,
            mousewheelScrolling: false
        });
    });
</script>


