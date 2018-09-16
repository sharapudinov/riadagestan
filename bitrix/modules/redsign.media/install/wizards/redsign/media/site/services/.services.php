<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServices = Array(
    "main" => Array(
		"NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
		"STAGES" => Array(
			"files.php", // Copy bitrix files
			"search.php", // Indexing files
			"template.php", // Install template
			"theme.php", // Install theme
			"menu.php", // Install menu
			"settings.php",
		),
	),
    "iblock" => Array(
		"NAME" => GetMessage("SERVICE_IBLOCK_DEMO_DATA"),
        "STAGES" => Array(
            "types.php",
            "news.php",
            // /new
			"binds_items.php",
        )
    ),
    "subscribe" => Array(
		"NAME" => GetMessage("SERVICE_SUBSCRIBE")
	),
    "redsign" => Array(
		"NAME" => GetMessage("SERVICE_REDSIGN"),
        "STAGES" => Array(
			"devfunc.php",
			"tuning.php",
			"settings.php",
		),
        "MODULE_ID" => "redsign.media"
	),
);
?>