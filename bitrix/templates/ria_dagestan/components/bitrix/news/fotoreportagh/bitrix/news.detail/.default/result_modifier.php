<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult['ITEMS_THEME'] = array();
if(!empty($arResult["DISPLAY_PROPERTIES"]["THEME"]["VALUE"]))
{
	$rsElementTheme = CIBlockElement::GetList(
		array(
			"active_from" => "DESC"
		),
		array(
			"PROPERTY_THEME" => $arResult["DISPLAY_PROPERTIES"]["THEME"]["VALUE"],
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
			"IBLOCK_ID" => $arResult["IBLOCK_ID"],
			"!ID" => $arResult["ID"]
		),
		false,
		Array ("nTopCount" => 5),
		array("ID", "NAME", "DETAIL_PAGE_URL")
	);

	while($obElementTheme = $rsElementTheme->GetNextElement())
	{
		$arItemTheme = $obElementTheme->GetFields();
		$arResult['ITEMS_THEME'][] = $arItemTheme;
	}
}

            for ($ii = 0; $ii < count($arResult["PROPERTIES"]["images_reportagh"]["VALUE"]); $ii++) {

                $arFileTmp = CFile::ResizeImageGet(
                    CFile::GetFileArray($arResult["PROPERTIES"]["images_reportagh"]["VALUE"][$ii]),
                    array("width" => '314', "height" => '270'),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );

                $arResult['resized'][$ii] = array(
                    "SRC" => $arFileTmp["src"],
                    "WIDTH" => $arFileTmp["width"],
                    "HEIGHT" => $arFileTmp["height"],
                );
            }

?>