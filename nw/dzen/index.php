<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Yandex Dzen");
?><?$APPLICATION->IncludeComponent(
	"bitrix:rss.out", 
	"yandex_dzen", 
	array(
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "27",
		"IBLOCK_TYPE" => "articles",
		"NUM_DAYS" => "300",
		"NUM_NEWS" => "20",
		"RSS_TTL" => "60",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"YANDEX" => "N",
		"COMPONENT_TEMPLATE" => "yandex_dzen"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>