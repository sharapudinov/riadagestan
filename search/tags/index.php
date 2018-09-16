<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords_inner", "Новости по тегам");
$APPLICATION->SetPageProperty("title", "Новости по тегам");
$APPLICATION->SetPageProperty("keywords", "Новости по тегам");
$APPLICATION->SetPageProperty("description", "Новости по тегам");
$APPLICATION->SetTitle("Новости по тегам");
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:search.page",
    "tags",
    array(
        "RESTART" => "N",
        "NO_WORD_LOGIC" => "N",
        "CHECK_DATES" => "N",
        "USE_TITLE_RANK" => "N",
        "DEFAULT_SORT" => "rank",
        "FILTER_NAME" => "",
        "arrFILTER" => array(
            0 => "iblock_news",
        ),
        "arrFILTER_iblock_news" => array(
            0 => "2",
        ),
        "SHOW_WHERE" => "Y",
        "arrWHERE" => array(
            0 => "iblock_news",
        ),
        "SHOW_WHEN" => "N",
        "PAGE_RESULT_COUNT" => "10",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Результаты поиска",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "my",
        "USE_LANGUAGE_GUESS" => "Y",
        "TAGS_SORT" => "NAME",
        "TAGS_PAGE_ELEMENTS" => "150",
        "TAGS_PERIOD" => "",
        "TAGS_URL_SEARCH" => "/search.php",
        "TAGS_INHERIT" => "Y",
        "FONT_MAX" => "50",
        "FONT_MIN" => "10",
        "COLOR_NEW" => "000000",
        "COLOR_OLD" => "C8C8C8",
        "PERIOD_NEW_TAGS" => "30",
        "SHOW_CHAIN" => "N",
        "COLOR_TYPE" => "N",
        "WIDTH" => "100%",
        "USE_SUGGEST" => "N",
        "SHOW_RATING" => "N",
        "RATING_TYPE" => "",
        "PATH_TO_USER_PROFILE" => "/forum/user/#USER_ID#/",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>