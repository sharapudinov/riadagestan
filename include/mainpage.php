<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?><?
if(isset($_POST['mmmdata'])){
	$dateget = $_POST['mmmdata'];
	$DateFrom = "$dateget 00:00:00";
	$DateTo = "$dateget 23:59:59";

	$arrFilter_lenta = array (
		"IBLOCK_ID" => 2,  
		"ACTIVE" => "Y",
		">=DATE_ACTIVE_FROM" => $DateFrom,
		"<=DATE_ACTIVE_FROM" => $DateTo,
	);
}else{
	$arrFilter_lenta = array (
	"IBLOCK_ID" => 2,  
	"ACTIVE" => "Y",
	"PROPERTY_lenta_VALUE" => "1");
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"lenta_news",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_IMG_WIDTH" => "136",
		"DISPLAY_IMG_HEIGHT" => "101",
		"USE_RSS" => "Y",
		"TITLE_RSS" => "",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "134",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arrFilter_lenta",
		"FIELD_CODE" => array("DATE_ACTIVE_FROM"),
		"PROPERTY_CODE" => array("VIDEO", "MOLNIYA", "MORE_PHOTO"),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
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
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "my",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?>