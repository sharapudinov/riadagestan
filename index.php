<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "Новости, Дагестан, РИА");
$APPLICATION->SetPageProperty("description", "Республиканское Информационное Агентство");
$APPLICATION->SetTitle("")
?>
<?$APPLICATION->IncludeComponent("bitrix:news.list","main_page_video",Array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "Y",
        "IBLOCK_TYPE" => "scrypts",
        "IBLOCK_ID" => "26",
        "NEWS_COUNT" => "1"
    )
);?>
    <div class="left">

        <div class="banner_top">
            <? $APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                "",
                Array(
                    "TYPE" => "LEFT1",
                    "NOINDEX" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_NOTES" => ""
                )
            ); ?>
        </div>
        <div class="sber_banner">
            <? $APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                ".default",
                array(
                    "TYPE" => "GL261x215",
                    "NOINDEX" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_NOTES" => ""
                ),
                false
            ); ?>
        </div>



        <? $arrFilter2 = array(
            "IBLOCK_ID" => 2,
            "ACTIVE" => "Y",
            "PROPERTY_MYFILTER_VALUE" => "1",
        );
        ?>
        <? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"glav_news", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter2",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "m_data",
			2 => "IMAGES",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "360000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_IMG_WIDTH" => "136",
		"DISPLAY_IMG_HEIGHT" => "101",
		"USE_RSS" => "Y",
		"TITLE_RSS" => "Главные новости информационного портала",
		"AJAX_OPTION_ADDITIONAL" => "glav",
		"COMPONENT_TEMPLATE" => "glav_news",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
); ?>
        <div class="archive">
            <div class="zagolovok_fon">
                <h2 class="zagolovok_text">Архив</h2>
            </div>
            <div class="calendar">
                <div id="datepicker"></div>
                <input type="hidden" id="alternate" size="30"/>

            </div>
        </div>


        <div class="banner_left">
            <?  $APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	".default",
	array(
		"TYPE" => "GLL2",
		"NOINDEX" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3000000",
		"CACHE_NOTES" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"QUANTITY" => "1"
	),
	false
);  ?>
        </div>
        <? $arrFilterInterView = array(
            "IBLOCK_ID" => 2,
            "ACTIVE" => "Y",
            "SECTION_ID" => "122",
        );
        ?>
        <? $APPLICATION->IncludeComponent("bitrix:news.list", "interview", array(
            "IBLOCK_TYPE" => "news",
            "IBLOCK_ID" => "2",
            "NEWS_COUNT" => "6",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrFilterInterView",
            "FIELD_CODE" => array(
                0 => "",
                1 => "SECTION_ID",
                2 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "m_data",
                1 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "интервью",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_IMG_WIDTH" => "80",
            "DISPLAY_IMG_HEIGHT" => "80",
            "USE_RSS" => "Y",
            "TITLE_RSS" => "",
            "AJAX_OPTION_ADDITIONAL" => "interview"
        ),
            false
        ); ?>
    </div>

    <div class="center">
        <? $arrFilter1 = array(
            "IBLOCK_ID" => 2,
            "ACTIVE" => "Y",
            "PROPERTY_MAIN_VALUE" => "1",
        );
        ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "main_news_slaider",
            array(
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "2",
                "NEWS_COUNT" => "3",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "arrFilter1",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "MAIN",
                    1 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "my",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_IMG_WIDTH" => "710",
                "DISPLAY_IMG_HEIGHT" => "350",
                "USE_RSS" => "Y",
                "TITLE_RSS" => "",
                "AJAX_OPTION_ADDITIONAL" => "",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y"
            ),
            false
        ); ?>
        <?
        if (isset($_GET['mmmdata']))
        {
            $dateget = $_GET['mmmdata'];
            $DateFrom = "$dateget 00:00:00";
            $DateTo = "$dateget 23:59:59";

            $arrFilter_lenta = array(
                "IBLOCK_ID" => 2,
                "ACTIVE" => "Y",
                "PROPERTY_lenta_VALUE" => "1",
                ">=DATE_ACTIVE_FROM" => $DateFrom,
                "<=DATE_ACTIVE_FROM" => $DateTo,
            );
        } else
        {
            $arrFilter_lenta = array(
                "IBLOCK_ID" => 2,
                "ACTIVE" => "Y",
                "PROPERTY_lenta_VALUE" => "1");
        }
        ?>

        <div class="mlentanews">
            <? $APPLICATION->IncludeComponent("bitrix:news.list", "lenta_news", array(
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "2",
                "NEWS_COUNT" => "34",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "arrFilter_lenta",
                "FIELD_CODE" => array(
                    0 => "DATE_ACTIVE_FROM",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "VIDEO",
                    1 => "MOLNIYA",
                    2 => "MORE_PHOTO",
                    3 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
                "SET_TITLE" => "Y",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "my",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_IMG_WIDTH" => "136",
                "DISPLAY_IMG_HEIGHT" => "101",
                "USE_RSS" => "Y",
                "TITLE_RSS" => "",
                "AJAX_OPTION_ADDITIONAL" => ""
            ),
                false
            ); ?>
        </div>
        <div class="right">
            <div class="banner_right_top">
                <? $APPLICATION->IncludeComponent(
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
); ?>
            </div>
            <? $arrFilterAnalytics = array(
                "IBLOCK_ID" => 2,
                "ACTIVE" => "Y",
                "SECTION_ID" => "112",
            );
            ?>
            <? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"analytics", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "TIMESTAMP_X",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "SECTION_ID",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "IMAGES",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "kartina_dnya",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Аналитика",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_IMG_WIDTH" => "137",
		"DISPLAY_IMG_HEIGHT" => "101",
		"USE_RSS" => "Y",
		"TITLE_RSS" => "Аналитика",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPONENT_TEMPLATE" => "analytics",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
); ?>
            <? global $arFilterMainVideo;
            $arFilterMainVideo = array(
                "IBLOCK_ID" => 13,
                "PROPERTY_main_video_VALUE" => '1');

            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "video",
                array(
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "13",
                    "NEWS_COUNT" => "1",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arFilterMainVideo",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "video_iframe",
                        1 => "main_video",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "N",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_IMG_WIDTH" => "136",
                    "DISPLAY_IMG_HEIGHT" => "101",
                    "USE_RSS" => "Y",
                    "TITLE_RSS" => "Главные новости информационного портала",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y"
                ),
                false
            );
            ?>
            <div class="banner_zona">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

                <!-- VK Widget -->
                <div id="vk_groups"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 3, width: "273"}, 20003922);
                </script>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	".default",
	array(
		"TYPE" => "president",
		"NOINDEX" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"COMPONENT_TEMPLATE" => ".default",
		"QUANTITY" => "1"
	),
	false
); ?></div>


                <div class="banner_bottom">

                    <? $APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	".default",
	array(
		"TYPE" => "nsrd",
		"NOINDEX" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"COMPONENT_TEMPLATE" => ".default",
		"QUANTITY" => "1"
	),
	false
); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "pravitelstvord",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "mingosim",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "press",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600000"
                        ),
                        false
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "socie_nadzor",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <!--<div class="banner_bottom">
                    <?/* $APPLICATION->IncludeComponent("bitrix:advertising.banner", "", array(
	"TYPE" => "prior",
		"NOINDEX" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
); */?>
                </div>-->

                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "mir",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        ),
                        false
                    ); ?>
                </div>

                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "prometheus",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "kavpolcentr",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        ),
                        false
                    ); ?>
                </div>
                <!--<div class="banner_bottom">
                    <? /* $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "forum",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000000000",
                            "CACHE_NOTES" => ""
                        )
                    ); */ ?>
                </div>-->
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "zamir",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom">
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "fotoreportagh",
            array(
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "11",
                "NEWS_COUNT" => "4",
                "SORT_BY1" => "DATE_CREATE",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "DATE_CREATE",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "j F Y",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_IMG_WIDTH" => "235",
                "DISPLAY_IMG_HEIGHT" => "150",
                "USE_RSS" => "Y",
                "TITLE_RSS" => "Главные новости информационного портала",
                "AJAX_OPTION_ADDITIONAL" => "",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y"
            ),
            false
        ); ?>

        <? $APPLICATION->IncludeComponent("bitrix:news.list", "themes", array(
            "IBLOCK_TYPE" => "news",
            "IBLOCK_ID" => "1",
            "NEWS_COUNT" => "6",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array(
                0 => "PREVIEW_PICTURE",
                1 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_IMG_WIDTH" => "220",
            "DISPLAY_IMG_HEIGHT" => "185",
            "USE_RSS" => "N",
            "TITLE_RSS" => "Новости информационного портала",
            "AJAX_OPTION_ADDITIONAL" => ""
        ),
            false
        ); ?>
        <div class="mvoting">
            <div>
                <? $APPLICATION->IncludeFile(
                    SITE_DIR . "include/history.php",
                    array(),
                    array("MODE" => "html")
                ); ?>
            </div>

            <div class="weather">
                <div class="zagolovok_fon">
                    <h2 class="zagolovok_text">Погода</h2>
                </div>

                <!-- Gismeteo informer START -->
                <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/gs_informerClient.min.css') ?>

                <div id="gsInformerID-r3WY265kUr0V40" class="gsInformer" style="width:275px;height:243px">
                    <div class="gsIContent">
                        <div id="cityLink">
                            <a href="https://www.gismeteo.ru/city/daily/5270/" target="_blank">Погода в
                                Махачкале</a>
                        </div>
                        <div class="gsLinks">
                            <table>
                                <tr>
                                    <td>
                                        <div class="leftCol">
                                            <a href="https://www.gismeteo.ru" target="_blank">
                                                <img alt="Gismeteo" title="Gismeteo"
                                                     src="https://www.gismeteo.ru/static/images/informer2/logo-mini2.png"
                                                     align="absmiddle" border="0"/>
                                                <span>Gismeteo</span>
                                            </a>
                                        </div>
                                        <div class="rightCol">
                                            <a href="https://www.gismeteo.ru/city/weekly/5270/" target="_blank">Прогноз
                                                на 2 недели</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <script src="https://www.gismeteo.ru/ajax/getInformer/?hash=r3WY265kUr0V40"
                        type="text/javascript"></script>
                <!-- Gismeteo informer END -->
            </div>
            <div class="currency">
                <div class="zagolovok_fon">
                    <h2 class="zagolovok_text">Калейдоскоп</h2>
                </div>
                <?$d=date('z')+1?>
                <img src="/daypictures/<?=$d?>.jpg">
                <!--<script type="text/javascript">
                    var userFeed = new Instafeed({
                        get: 'user',
                        userId: '726669693',
                        accessToken: '7165229916.346d0a5.6723b9d830cd4ab9ab79cb213e1310a4'
                    });
                    userFeed.run();
                </script>-->
               <?/*$APPLICATION->IncludeComponent("infocom:currency", ".default", array(
	"COMPONENT_TEMPLATE" => ".default",
		"CURR" => array(
			0 => "USD",
			1 => "EUR",
			2 => "GBP",
			3 => "CHF",
			4 => "JPY",
		),
		"STYLE" => "ic",
		"DIGITS" => "2",
		"DELIMITER" => ".",
		"DATE_FORMAT" => "d.m.Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"COUNT_KR" => "1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"VAL_0_1" => "EUR",
		"VAL_0_2" => "USD"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);*/?>
            </div>

        </div>

        <div class="big_banner">
            <? $APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                "",
                Array(
                    "TYPE" => "footer_banner",
                    "NOINDEX" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600000000000"
                )
            ); ?>
        </div>

       
        <div class="msection">
            <? $arrFilter3 = array(
                "IBLOCK_ID" => 2,
                "ACTIVE" => "Y",
                "PROPERTY_edition_VALUE" => "1",
            );
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "edition",
                array(
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "2",
                    "NEWS_COUNT" => "9",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilter3",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "IMAGES",
                        2 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "N",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y H:i",
                    "SET_TITLE" => "Y",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_IMG_WIDTH" => "136",
                    "DISPLAY_IMG_HEIGHT" => "101",
                    "USE_RSS" => "Y",
                    "TITLE_RSS" => "Главные новости информационного портала",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y"
                ),
                false
            ); ?>
        </div>

        <div class="vidzhet">
            <div class="vidzhet-block"> <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "",
                    Array(
                        "TYPE" => "bottom1",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000"
                    )
                ); ?>
            </div>

            <div class="vidzhet-block"> <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    ".default",
                    array(
                        "TYPE" => "bottom7",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000"
                    ),
                    false
                ); ?>
            </div>

            <div class="vidzhet-block">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "",
                    Array(
                        "TYPE" => "bottom3",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000"
                    )
                ); ?>
            </div>

            <div class="vidzhet-block">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    ".default",
                    array(
                        "TYPE" => "bottom4",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000"
                    ),
                    false
                ); ?>
            </div>
            <!--
            <div class="vidzhet-block">
                <? /* $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "",
                    Array(
                        "TYPE" => "bottom5",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000000"
                    )
                ); */ ?>
            </div>

            <div class="vidzhet-block">
                <? /* $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "",
                    Array(
                        "TYPE" => "bottom6",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600000000"
                    )
                ); */ ?>
            </div>

            <div class="vidzhet-block">
                <? /* $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "",
                    Array(
                        "TYPE" => "bottom7",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600000000"
                    )
                ); */ ?>
            </div>

            <div class="vidzhet-block">
                <? /* $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "",
                    Array(
                        "TYPE" => "bottom8",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "360000000"
                    )
                ); */ ?>
            </div>-->
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
<script type="text/javascript">
    $('#currency_frame').on('load',function(){
        window.scroll(0,0);
    });
</script>