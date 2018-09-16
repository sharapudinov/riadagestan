<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["ITEMS"] as $key => $arItem)
{
	$res = CIBlockSection::GetList(array(), array("ID" => $arItem['IBLOCK_SECTION_ID']), false, array("SECTION_PAGE_URL", "NAME"));
	if($ar_res = $res->GetNext())
		$arResult["ITEMS"][$key]["SECTION"] = $ar_res["NAME"];

}
