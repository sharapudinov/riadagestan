<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Поиск");
$APPLICATION->SetPageProperty("title", "Поиск");
$APPLICATION->SetPageProperty("keywords", "Поиск");
$APPLICATION->SetPageProperty("description", "Поиск");
$APPLICATION->SetTitle("Поиск");

if (isset($errrrror)) {
    echo "<h3 style='color:red'>$errrrror</h3>";
}
?> <? $APPLICATION->IncludeComponent("bitrix:search.page", ".default", array(
    "RESTART" => "N",
    "NO_WORD_LOGIC" => "N",
    "CHECK_DATES" => "N",
    "USE_TITLE_RANK" => "N",
    "DEFAULT_SORT" => "rank",
    "FILTER_NAME" => "",
    "arrFILTER" => array(
        0 => "iblock_news",
    ),
    "SHOW_WHERE" => "N",
    "SHOW_WHEN" => "N",
    "PAGE_RESULT_COUNT" => "20",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Результаты поиска",
    "PAGER_SHOW_ALWAYS" => "Y",
    "PAGER_TEMPLATE" => "my",
    "USE_LANGUAGE_GUESS" => "Y",
    "USE_SUGGEST" => "N",
    "SHOW_RATING" => "",
    "RATING_TYPE" => "",
    "PATH_TO_USER_PROFILE" => "",
    "AJAX_OPTION_ADDITIONAL" => ""
),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>