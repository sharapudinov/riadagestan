<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	".default", 
	array(
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"PAGE" => "#SITE_DIR#search/index.php",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "iblock_news",
		)
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:search.tags.input", 
	".default", 
	array(
		"PAGE_ELEMENTS" => "10",
		"SORT_BY_CNT" => "Y",
		"TEXT" => "",
		"TMPL_IFRAME" => "Y",
		"NAME" => "TAG",
		"VALUE" => "",
		"SITE_ID" => "ru",
		"arrFILTER" => "iblock_news",
		"arrFILTER_iblock_news" => "2"
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form", 
	".default", 
	array(
		"USE_SUGGEST" => "Y",
		"PAGE" => "#SITE_DIR#search/index.php"
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:search.tags.cloud",
	"",
	Array(
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"SORT" => "NAME",
		"PAGE_ELEMENTS" => "150",
		"PERIOD" => "",
		"URL_SEARCH" => "/search/index.php",
		"TAGS_INHERIT" => "Y",
		"CHECK_DATES" => "N",
		"FILTER_NAME" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"arrFILTER" => array()
	),
false
);?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.search", 
	".default", 
	array(
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"RESTART" => "N",
		"NO_WORD_LOGIC" => "N",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>