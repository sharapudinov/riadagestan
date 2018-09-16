<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Видео");
?>
    <div class="videopage">
        <div class="zagolovok_fon">
            <h2 class="zagolovok_text">Видео</h2>
        </div>
        <? //Главные новости
        $arrFiltervideo = array(
            "IBLOCK_ID" => 13,
            "ACTIVE" => "Y",
            "PROPERTY_main_video_VALUE" => "1",
        );
        ?> <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "video_main",
            Array(
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "13",
                "NEWS_COUNT" => "1",
                "SORT_BY1" => "DATE_CREATE",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "DATE_CREATE",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "arrFiltervideo",
                "FIELD_CODE" => array(0 => "DATE_CREATE", 1 => "",),
                "PROPERTY_CODE" => array(0 => "main_video", 1 => "",),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "N",
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
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "my",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_IMG_WIDTH" => "80",
                "DISPLAY_IMG_HEIGHT" => "56",
                "USE_RSS" => "Y",
                "TITLE_RSS" => "Новости информационного портала",
                "AJAX_OPTION_ADDITIONAL" => ""
            )
        ); ?>
        <? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"video_full_list", 
	array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "13",
		"NEWS_COUNT" => "6",
		"SORT_BY1" => "DATE_CREATE",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "DATE_CREATE",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "DATE_CREATE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "main_video",
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
		"CACHE_FILTER" => "N",
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
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "my",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_IMG_WIDTH" => "80",
		"DISPLAY_IMG_HEIGHT" => "56",
		"USE_RSS" => "Y",
		"TITLE_RSS" => "Новости информационного портала",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y"
	),
	false
); ?>

    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>