<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
/*test_dump($arResult);*/
?>
<? IncludeTemplateLangFile(__FILE__); ?>
<style>
    .right_news_block_m {
        display: none;
    }
</style>
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
                    href="<?= '/mobile' . $arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"] ?>"><? echo $arResult["SECTION"]["PATH"][0]["NAME"] ?></a>
                <? if ($arResult["SECTION"]["PATH"][1]["NAME"] != null): ?>
                    &nbsp;-&nbsp;<a
                        href="<?= '/mobile' . $arResult["SECTION"]["PATH"][1]["SECTION_PAGE_URL"] ?>"><? echo $arResult["SECTION"]["PATH"][1]["NAME"] ?></a>
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
        <div class="clear"></div>



        <?  if ($arResult["PROPERTIES"]["VR360"]["VALUE"]){
            $path = CFile::GetPath($arResult["PROPERTIES"]["VR360"]["VALUE"]);
            $name = end(explode('/', $path));
            $newpath = $_SERVER['DOCUMENT_ROOT'] . '/vrtest/' . $name;
            if (!file_exists($newpath)) {
                copy($_SERVER['DOCUMENT_ROOT'] . $path, $newpath);
            } ?>
            <iframe width="100%" height="600px" allowfullscreen="" frameborder="0"
                    src="//storage.googleapis.com/vrview/index.html?image=//riadagestan.ru/vrtest/<?= $name ?>"></iframe>
            <?
        }
        elseif ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null) {
            ?>
            <div class="box1">
                    <ul class="rslides">
                        <?
                        for ($ii = 0; $ii < count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]); $ii++) {
                            //формируем водяной знак на анонсных и на основных картинках
                            $result_image_big = CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][ $ii ]);
                            $dc_result_image1 = $_SERVER["DOCUMENT_ROOT"] . $result_image_big;
                       /* if($USER->IsAdmin()) {
                            unlink($dc_result_image1);
                        }*/
                            if (!file_exists($dc_result_image1)) {
                                    CFile::ResizeImageFile(
                                    $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]),
                                    $dc_result_image1,
                                    array("width"=>800, "height"=>600),
                                    BX_RESIZE_IMAGE_EXACT,
                                    array(
                                        "type" => "image",
                                        "file" => $_SERVER["DOCUMENT_ROOT"] . "/upload/big_water2.png",
                                        "size" => "real",
                                        "alpha_level" => 100, // 0 - 100
                                        "position" => "br",
/*                                        "fill" => 'resize', // resize | repeat*/
                                    )
                                );
                            }
                            ?>


                            <li class="gallery-item">
                                <img src="<?= $result_image_big; ?>" height="600px"/>
                            </li>
                            <?
                            //break;
                        }
                        ?>
                    </ul>

                    <script>

                        $(function () {
                            $(".rslides").responsiveSlides();
                        });
                        $(".rslides").responsiveSlides({
                            auto: true,             // Boolean: Animate automatically, true or false
                            speed: 500,            // Integer: Speed of the transition, in milliseconds
                            timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
                            pager: false,           // Boolean: Show pager, true or false
                            nav: true,             // Boolean: Show navigation, true or false
                            random: false,          // Boolean: Randomize the order of the slides, true or false
                            pause: false,           // Boolean: Pause on hover, true or false
                            pauseControls: true,    // Boolean: Pause when hovering controls, true or false
                            prevText: "",   // String: Text for the "previous" button
                            nextText: "",       // String: Text for the "next" button
                            maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                            navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                            manualControls: "",     // Selector: Declare custom pager navigation
                            namespace: "rslides",   // String: Change the default namespace used
                            before: function () {
                            },   // Function: Before callback
                            after: function () {
                            }     // Function: After callback
                        });
                    </script>
                <br>
                <span class="mvideo">
            <?
            if ($arResult["PROPERTIES"]["VIDEO"]["VALUE"]) :


                ?>
                <?= htmlspecialchars_decode(
                str_replace(
                    "ifr ame",
                    "iframe",
                    mobile_iframe($arResult["PROPERTIES"]["VIDEO"]["VALUE"])
                )
            ) ?>
            <? endif ?>
            </div><!-- end box -->
        <? } ?>
<div class="clear"></div>

<div>
        <p>
            <? echo $arResult["DETAIL_TEXT"]; ?>
        </p>
</div>
    </div>
    <div class="pager_bottom">
        <ul class="box_pager">
            <? if ($arResult["PROPERTIES"]["author"]["VALUE"] != ""  && $arResult["PROPERTIES"]["not_view_author"]["VALUE"]!=='Y') { ?>
                <li>
                    <?= GetMessage("author") ?>: &nbsp;<?= $arResult["PROPERTIES"]["author"]["VALUE"] ?>
                </li>
            <? } ?>
            <? if ($arResult["PROPERTIES"]["on_of_views"]["VALUE"] == 1): ?>

                <li>
                    <?= GetMessage("total_views") ?>:
                    <b>
                        <? $frame = $this->createFrame('area', false)->begin('загрузка'); ?>
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
<div class="clear"></div>

<? $arThemes = $arResult['PROPERTIES']['THEME']['VALUE'];

if (is_array($arThemes))
    $GLOBALS["arrFilterTheme"] = array("PROPERTY_THEME" => $arThemes, "!ID" => $arResult["ID"]);
elseif (CModule::IncludeModule('iblock')) {
    $dbSection = CIBlockElement::GetElementGroups($arResult['ID'], true, array("ID"));
    $arSection = $dbSection->getNext();
    $GLOBALS["arrFilterTheme"] = array("SECTION_ID" => $arSection["ID"], "!ID" => $arResult["ID"]);
}

?>
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter,whatsapp,telegram"></div>
<br>
<?
$APPLICATION->IncludeComponent(
    "bitrix:advertising.banner",
    ".default",
    array(
        "TYPE" => "GLR1264x84",
        "NOINDEX" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "COMPONENT_TEMPLATE" => ".default",
        "QUANTITY" => "1"
    ),
    false
);

if (SITE_ID == 's1') {
    $iblock_id = 2;
    $iblock_type = "news";
}
if (SITE_ID == 's2') {
    $iblock_id = '16';
    $iblock_type = "news_en";
}
$component->arResult["LIST_SUB_NEWS"] = $APPLICATION->IncludeComponent("bitrix:news.list", "main_theme_news", array(
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "AJAX_MODE" => "N",
    "IBLOCK_TYPE" => $iblock_type,
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
    "DETAIL_URL" => "/mobile/#IBLOCK_CODE#/#SECTION_CODE#/#ELEMENT_CODE#/",
    "PREVIEW_TRUNCATE_LEN" => "",
    "ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
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



