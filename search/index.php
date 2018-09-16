<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
if (SITE_TEMPLATE_ID == 'ria_dagestan_mobile_template') {
    $arUrl = parse_url($_REQUEST['REQUEST_URI']);
    LocalRedirect('/mobile/search.php' . '?' . http_build_query($_REQUEST));
}

$query = $_GET['q'];

if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/", $query)) {
    $_GET['q'] = "";
    $errrrror = "Вы использовали в запросе запрещенный символ";
}


$APPLICATION->SetPageProperty("keywords_inner", "Поиск");
$APPLICATION->SetPageProperty("title", "Поиск");
$APPLICATION->SetPageProperty("keywords", "Поиск");
$APPLICATION->SetPageProperty("description", "Поиск");
$APPLICATION->SetTitle("Поиск");

if (isset($errrrror)) {
    echo "<h3 style='color:red'>$errrrror</h3>";
}
?> <? $APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	".default", 
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
		"SHOW_WHERE" => "N",
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "15",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
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
		"AJAX_OPTION_ADDITIONAL" => "",
		"arrFILTER_iblock_news" => array(
			0 => "all",
		)
	),
	false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>