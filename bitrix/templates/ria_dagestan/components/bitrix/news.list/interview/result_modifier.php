<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["ITEMS"] as $key => $arItem)
{
	$res = CIBlockSection::GetList(array(), array("ID" => $arItem['IBLOCK_SECTION_ID']), false, array("SECTION_PAGE_URL", "NAME"));
	if($ar_res = $res->GetNext())
		$arResult["ITEMS"][$key]["SECTION_URL"] = '<a href="'.$ar_res["SECTION_PAGE_URL"] .'">'.$ar_res["NAME"].'</a>';

	if(is_array($arItem["PROPERTIES"]["IMAGES"]["VALUE"]))
	{
		$arFileTmp = CFile::ResizeImageGet(
			$arItem["PROPERTIES"]["IMAGES"]["VALUE"][0],
			array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
			BX_RESIZE_IMAGE_EXACT,
			true
		);

		$arResult["ITEMS"][$key]["PREVIEW_IMG_MEDIUM"] = array(
			"SRC" => $arFileTmp["src"],
			"WIDTH" => $arFileTmp["width"],
			"HEIGHT" => $arFileTmp["height"],
		);
	}
}
?>