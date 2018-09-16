<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams['CACHE_TIME'])) {
	$arParams['CACHE_TIME'] = 3600;
}

if($arParams['IBLOCK_ID'] < 1) {
	ShowError(GetMessage('IBLOCK_NOT_DEFINED'));
	return false;
}

if(!CModule::IncludeModule('iblock')) {
	ShowError('IBLOCK_MODULE_NOT_INSTALLED');
	return false;
}

# buttons
$arButtons = CIBlock::GetPanelButtons(
	$arParams['IBLOCK_ID'],
	0,
	0,
	array("SECTION_BUTTONS"=>false, "SESSID"=>false)
);
$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

# properties names for dates in _CIBElement::GetFields()
$dateStartProp = (strpos($arParams['DATE_START'], 'PROPERTY_')===0) ? $arParams['DATE_START'].'_VALUE' : $arParams['DATE_START'];
$dateEndProp = (strpos($arParams['DATE_END'], 'PROPERTY_')===0) ? $arParams['DATE_END'].'_VALUE' : $arParams['DATE_END'];

# embedding scrips & styles
$APPLICATION->AddHeadString('<link type="text/css" rel="stylesheet" href="'.$this->getPath().'/assets/css/jscal2.css" />');
$APPLICATION->AddHeadString('<link type="text/css" rel="stylesheet" href="'.$this->getPath().'/assets/css/tooltip.css" />');

$APPLICATION->AddHeadString('<script type="text/javascript" charset="utf-8" data-main="'.$this->getPath().'/assets/js/main" src="'.$this->getPath().'/assets/js/require.min.js"></script>');
$APPLICATION->AddHeadString('<script type="text/javascript" charset="utf-8" src="'.$this->getPath().'/assets/js/src/jscal2.js"></script>');
$APPLICATION->AddHeadString('<script type="text/javascript" charset="utf-8" src="'.$this->getPath().'/assets/js/src/unicode-letter.js"></script>');
$APPLICATION->AddHeadString('<script type="text/javascript" charset="utf-8" src="'.$this->getPath().'/assets/js/src/underscore.min.js"></script>');
$APPLICATION->AddHeadString('<script type="text/javascript" charset="utf-8" src="'.$this->getPath().'/assets/js/src/calendar-'.(LANGUAGE_ID=='ru'?'ru':'en').'.js'.'"></script>');

# json pretty print
if(!function_exists('jsonPrettyPrint')) {
	function jsonPrettyPrint($json) {
		$result = '';
		$level = 0;
		$prev_char = '';
		$in_quotes = false;
		$ends_line_level = NULL;
		$json_length = strlen( $json );

		for( $i = 0; $i < $json_length; $i++ ) {
			$char = $json[$i];
			$new_line_level = NULL;
			$post = "";
			if( $ends_line_level !== NULL ) {
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}
			if( $char === '"' && $prev_char != '\\' ) {
				$in_quotes = !$in_quotes;
			} else if( ! $in_quotes ) {
				switch( $char ) {
					case '}': case ']':
					$level--;
					$ends_line_level = NULL;
					$new_line_level = $level;
					break;

					case '{': case '[':
					$level++;
					case ',':
						$ends_line_level = $level;
						break;

					case ':':
						$post = " ";
						break;

					case " ": case "\t": case "\n": case "\r":
					$char = "";
					$ends_line_level = $new_line_level;
					$new_line_level = NULL;
					break;
				}
			}
			if( $new_line_level !== NULL ) {
				$result .= "\n".str_repeat( "\t", $new_line_level );
			}
			$result .= $char.$post;
			$prev_char = $char;
		}

		return $result;
	}
}


# init cache
if($this->StartResultCache(false)) {
	$rsElement = CIBlockElement::GetList(
		array(
			$arParams['DATE_START'] => 'ASC'
		),
		array(
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ACTIVE' => 'Y'
			#'ACTIVE_DATE' => 'Y'
			#TODO добавить возможность выбора только прошедших и не наступивших событий
		),
		false,
		false,
		array(
			'ID',
			'NAME',
			'DETAIL_PAGE_URL',
			$arParams['DATE_START'],
			$arParams['DATE_END']
		)
	);

	if ($arParams['DETAIL_URL']) {
		$rsElement->SetUrlTemplates($arParams['DETAIL_URL']);
	}

	while($obElement = $rsElement->GetNextElement()) {
		$arElement = $obElement->GetFields();

		# start and end date in unix timestamp
		$arElement['dateStart'] = MakeTimeStamp($arElement[strtoupper($dateStartProp)]);
		$arElement['dateEnd'] = MakeTimeStamp($arElement[strtoupper($dateEndProp)]);

		$arResult['ITEMS'][] = $arElement;
	}

	# format array
	$arItems = array();
	foreach($arResult['ITEMS'] as $arItem) {
		# if date-start not exists - burn in hell
		if(!$arItem['dateStart']) continue;

		$arItem = array(
			'id' => $arItem['ID'],
			'name' => $arItem['~NAME'],
			'url' => $arItem['~DETAIL_PAGE_URL'],
			'dateStart' => $arItem['dateStart'],
			'dateEnd' => $arItem['dateEnd']
		);

		# group by start date
		$strDate = date('Ymd', $arItem['dateStart']);
		if(!isset($arItems[$strDate])) $arItems[$strDate] = array('klass' => 'calendarEvent ceDefault', 'tooltip'=>array(), 'data'=> array());

		$arItems[$strDate]['data'][] = $arItem;
		$arItems[$strDate]['tooltip'][] = '<a href="' . $arItem['url'] . '">' . $arItem['name'] . '</a>';
	}
	$arResult['ITEMS'] = $arItems;

	$this->IncludeComponentTemplate();
}

# print json with items
if(SITE_CHARSET == 'windows-1251') {
	if(!function_exists('arrayToUtfConvert')) {
		function arrayToUtfConvert(&$value, $key){
			$value = iconv('cp1251','UTF-8', $value);
		}
	}
	array_walk_recursive($arResult['ITEMS'], 'arrayToUtfConvert');
}

$APPLICATION->AddHeadString('<script type="text/javascript">var eventsJson='.jsonPrettyPrint(json_encode($arResult['ITEMS'])).';</script>');
?>