<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

# iblock type & id
$arTypesEx = CIBlockParameters::GetIBlockTypes(/*Array("-"=>" ")*/);

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch()) {
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
}

# start & end dates
$dateStartList = CIBlockProperty::GetList(
	array(
		'SORT' => 'ASC'
	),
	array(
		'IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'],
		'PROPERTY_TYPE' => 'S',
		'USER_TYPE' => 'DateTime'
	)
);

$arDateStart['DATE_ACTIVE_FROM'] = GetMessage('DATE_ACTIVE_FROM');
$arDateStart['DATE_ACTIVE_TO'] = GetMessage('DATE_ACTIVE_TO');
while($dateStartItem = $dateStartList->Fetch()) {
	$arDateStart['PROPERTY_'.$dateStartItem['CODE']] = $dateStartItem['NAME'];
}

$arDateEnd = array_merge(
	array('' => GetMessage('DATE_END_NO')),
	$arDateStart
);

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(

		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			#"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		'DATE_START' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage("DATE_START"),
			'TYPE' => 'LIST',
			'VALUES' => $arDateStart,
			'REFRESH' => 'Y'
		),
		'DATE_END' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage("DATE_END"),
			'TYPE' => 'LIST',
			'VALUES' => $arDateEnd,
			'DEFAULT' => 'DATE_ACTIVE_TO',
			'REFRESH' => 'Y'
		),
		'DETAIL_URL' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('DETAIL_URL'),
			'TYPE' => 'STRING'
		),
		
		/*"ITEMS_LIMIT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ITEMS_LIMIT"),
			"TYPE" => "STRING",
			"DEFAULT" => "10",
		),*/

		"CACHE_TIME" => Array("DEFAULT"=>3600),

	),
);
?>