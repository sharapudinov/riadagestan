<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Регистрация");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetPageProperty("keywords", "Регистрация");
$APPLICATION->SetPageProperty("description", "Регистрация");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"",
	Array(
		"USER_PROPERTY_NAME" => "",
		"SHOW_FIELDS" => array("NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_PROFESSION", "PERSONAL_WWW", "PERSONAL_GENDER", "PERSONAL_BIRTHDAY", "PERSONAL_PHOTO", "PERSONAL_PHONE", "PERSONAL_MAILBOX", "PERSONAL_CITY", "PERSONAL_COUNTRY"),
		"REQUIRED_FIELDS" => array("NAME", "LAST_NAME"),
		"AUTH" => "Y",
		"USE_BACKURL" => "N",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array()
	),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>