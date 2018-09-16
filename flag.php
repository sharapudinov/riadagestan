<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Опрос");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:voting.current",
	".userfield",
	array(
		"CHANNEL_SID" => "OPROS_O_SAITE",
		"VOTE_ID" => "8",
		"VOTE_ALL_RESULTS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"COMPONENT_TEMPLATE" => ".userfield",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>