<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнеры");
?><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 15px;">Страница находится в стадии разработки</span>
<div>
  <br />
</div>

<div><?$APPLICATION->IncludeComponent("bitrix:map.yandex.search", ".default", array(
	"INIT_MAP_TYPE" => "MAP",
	"MAP_WIDTH" => "100%",
	"MAP_HEIGHT" => "500",
	"MAP_DATA" => "a:3:{s:10:\"yandex_lat\";d:42.94961591131263;s:10:\"yandex_lon\";d:47.110988268044636;s:12:\"yandex_scale\";i:9;}",
	"CONTROLS" => array(
		0 => "ZOOM",
		1 => "MINIMAP",
		2 => "TYPECONTROL",
		3 => "SCALELINE",
	),
	"OPTIONS" => array(
		0 => "ENABLE_SCROLL_ZOOM",
		1 => "ENABLE_DBLCLICK_ZOOM",
		2 => "ENABLE_DRAGGING",
	),
	"MAP_ID" => ""
	),
	false
);?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>