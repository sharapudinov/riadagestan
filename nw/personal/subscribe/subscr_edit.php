<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit", 
	"media", 
	array(
		"AJAX_MODE" => "N",
		"SHOW_HIDDEN" => "Y",
		"ALLOW_ANONYMOUS" => "Y",
		"SHOW_AUTH_LINKS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "media",
		"AJAX_OPTION_ADDITIONAL" => "",
		"RS_USE_CONSENT" => "Y",
		"RS_CONSENT_ID" => "1"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>