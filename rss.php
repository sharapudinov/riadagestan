<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Информационный портал");
$GLOBALS["arrFilterRss"] = array("PROPERTY_RSS_VALUE" => 1);
?><?$APPLICATION->IncludeComponent("bitrix:rss.out", "", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "2",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"NUM_NEWS" => "40",
	"NUM_DAYS" => "30",
	"SORT_BY1" => "DATE_CREATE",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "DATE_CREATE",
	"SORT_ORDER2" => "DESC",
	"FILTER_NAME" => "arrFilterRss",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "N",
	"RSS_TTL" => "60",
	"YANDEX" => "Y"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
