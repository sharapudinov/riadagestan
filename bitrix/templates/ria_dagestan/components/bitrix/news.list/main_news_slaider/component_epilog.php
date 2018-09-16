<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/responsiveslides.min.js');



if(count($arResult["ELEMENTS"]) > 0){
	if(!empty($GLOBALS["arrFilterNews"]["!ID"]))
		$GLOBALS["arrFilterNews"]["!ID"] =  array_merge($GLOBALS["arrFilterNews"]["!ID"], $arResult["ELEMENTS"]);
	else
		$GLOBALS["arrFilterNews"]["!ID"] =  $arResult["ELEMENTS"];
}

