<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

if($this->StartResultCache(false, false))
{
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/xml.php");

$arParams['DIGITS'] = intval($arParams['DIGITS']);

$now_date = date("d/m/Y");
if(date('w') == 1)
	$last_date = date("d/m/Y", mktime(0, 0, 0, date('m'), (date('d')-3), date('Y')));
elseif(date('w') == 0)
	$last_date = date("d/m/Y", mktime(0, 0, 0, date('m'), (date('d')-2), date('Y')));
else
	$last_date = date("d/m/Y", mktime(0, 0, 0, date('m'), (date('d')-1), date('Y')));

$arResult['CBR']['DATE'] = date($arParams['DATE_FORMAT']);
$arResult['CBR']['LAST_DATE'] = $last_dates;

function getCurrencyDay($day)
{
	$strQueryText = QueryGetData("www.cbr.ru",80,"/scripts/XML_daily.asp?date_req=".$day,"",$error_number,$error_text);
	
	$objXML = new CDataXML();
	$objXML->LoadString($strQueryText);
	$arData = $objXML->GetArray();
	
	$result = array();
	foreach ($arData['ValCurs']['#']['Valute'] as $arValue)
	{
		$ar = array();
		foreach ($arValue['#'] as $sKey => $sVal)
		{
			if(SITE_CHARSET != "windows-1251")
				$sVal[0]['#'] = iconv("windows-1251",SITE_CHARSET,$sVal[0]['#']);
			if($sKey == 'Value')
				$sVal[0]['#'] = str_replace(',','.',$sVal[0]['#']);
			$ar[$sKey] = $sVal[0]['#'];
		}
		
		$result[$ar['CharCode']] = $ar;
	}
	return $result;
}

$currency_last_date = getCurrencyDay($last_date);
$currency_now_date = getCurrencyDay($now_date);

foreach($arParams['CURR'] as $cur):
	$res = array();
	$res['NAME'] = $currency_now_date[$cur]['Name'];
	$res['VAL'] = number_format(round($currency_now_date[$cur]['Value'],$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	$res['LAST_VALUE'] = number_format(round($currency_last_date[$cur]['Value'],$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	$res['NOMINAL'] = $currency_now_date[$cur]['Nominal'];
	if($currency_now_date[$cur]['Value'] > $res['LAST_VALUE'])
	{
		$res['CHANGE'] = 'up';
		$res['CHVAL'] = number_format(round($currency_now_date[$cur]['Value'] - $currency_last_date[$cur]['Value'],$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	}
	elseif($currency_now_date[$cur]['Value'] < $currency_last_date[$cur]['Value'])
	{
		$res['CHANGE'] = 'down';
		$res['CHVAL'] = number_format(round($currency_last_date[$cur]['Value'] - $currency_now_date[$cur]['Value'],$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	}
	else
	{
		$res['CHANGE'] = '';
		$res['CHVAL'] = '';
	}
	$arResult['CBR']['CUR'][$cur] = $res;
endforeach;

for($i = 0; $i < (intval($arParams["COUNT_KR"])); $i++):
	$res = array();
	$val_1 = $arParams['VAL_'.$i.'_1'];
	$val_2 = $arParams['VAL_'.$i.'_2'];
	$res['NAME'] = $val_1.'/'.$val_2;
	$res['VAL'] = number_format(round($currency_now_date[$val_1]['Value']/$currency_now_date[$val_2]['Value'],$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	$res['LAST_VALUE'] = number_format(round($currency_last_date[$val_1]['Value']/$currency_last_date[$val_2]['Value'],$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	if($currency_now_date[$val_1]['Value']/$currency_now_date[$val_2]['Value'] > $currency_last_date[$val_1]['Value']/$currency_last_date[$val_2]['Value'])
	{
		$res['CHANGE'] = 'up';
		$res['CHVAL'] = number_format(round(($currency_now_date[$val_1]['Value']/$currency_now_date[$val_2]['Value']) - ($currency_last_date[$val_1]['Value']/$currency_last_date[$val_2]['Value']),$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	}
	elseif($currency_now_date[$val_1]['Value']/$currency_now_date[$val_2]['Value'] < $currency_last_date[$val_1]['Value']/$currency_last_date[$val_2]['Value'])
	{
		$res['CHANGE'] = 'down';
		$res['CHVAL'] = number_format(round(($currency_last_date[$val_1]['Value']/$currency_last_date[$val_2]['Value']) - ($currency_now_date[$val_1]['Value']/$currency_now_date[$val_2]['Value']),$arParams['DIGITS']),$arParams['DIGITS'],$arParams['DELIMITER'], '');
	}
	else
	{
		$res['CHANGE'] = '';
		$res['CHVAL'] = '';
	}
	$arResult['CBR']['CUR'][] = $res;
endfor;

	$this->IncludeComponentTemplate();
}
?>