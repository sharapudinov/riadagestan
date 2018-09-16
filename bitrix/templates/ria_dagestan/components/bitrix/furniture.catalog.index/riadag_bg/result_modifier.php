<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['ITEMS'] as $key=>$arItem)
{
	$arFileTmp = CFile::ResizeImageGet(
		$arItem['PICTURE']["ID"],
		array("width" => 1920, "height" => 1080),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);

	$arResult['ITEMS'][$key]["PICTURE"] = array(
		'SRC' => $arFileTmp["src"],
		'WIDTH' => $arFileTmp["width"],
		'HEIGHT' => $arFileTmp["height"],
	);
}
?>