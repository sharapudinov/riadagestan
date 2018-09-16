<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><p>
 <b><?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view", 
	".default", 
	array(
		"API_KEY" => "AIzaSyAHujlVIhSdI0YLi9iaZNQTPjPNEMvLjLs",
		"CONTROLS" => array(
			0 => "SMALL_ZOOM_CONTROL",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.77309933770548;s:10:\"google_lon\";d:37.63267663917542;s:12:\"google_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:13:\"Media Project\";s:3:\"LON\";d:37.631987929344;s:3:\"LAT\";d:55.773109275207;}}}",
		"MAP_HEIGHT" => "350",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
			3 => "ENABLE_KEYBOARD",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?> <br>
	 Адрес:</b>
</p>
<p>
	 Media Project
</p>
<p>
	 Свидетельство о регистрации СМИ: 000110111 от 14 февраля 2007 года
</p>
<p>
	 г. Москва, пр-кт. Мира, д. 1а, кор. 2, офис 3145
</p>
<p>
 <b>Телефон:</b>
</p>
<p>
	 8 (800) 100-20-22
</p>
<p>
 <b>Идеи для материалов:</b>
</p>
<p>
 <a href="mailto:idea@example.com">idea@example.com</a>
</p>
<p>
	 Партнерам:
</p>
<p>
 <a href="mailto:partners@example.com">partners@example.com</a>
</p>
<p>
	 Рекламодателям:
</p>
<p>
 <a href="mailto:ad@example.com">ad@example.com</a>
</p>
<p>
	 Предложения:
</p>
<p>
 <a href="mailto:reports@example.com">reports@example.com</a>
</p>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>