<?php
#ini_set('error_reporting', E_ERROR );
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);

AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("MyClass", "OnBeforeIBlockElementDeleteHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("MyClass", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock","OnBeforeIBlockElementAdd", Array("MyClass", "OnBeforeIBlockElementAddHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("MyClass", "OnAfterIBlockElementAddHandler"));

require ('include/function.php');

class MyClass
{
    function OnAfterIBlockElementAddHandler(&$arFields){
		if ($arFields['IBLOCK_ID']==2 || $arFields['IBLOCK_ID']==16)
		{
			// обрезаем и добавляем водяной знак
			/*
                    $dbr =   CIBlockElement::GetProperty(
                        $arFields['IBLOCK_ID'],
                        $arFields['ID'],
                        array(),
                        array("CODE"=>'IMAGES')
                    );*/

			// обрезаем и добавляем водяной знак

			$dbr = CIBlockElement::GetProperty(
				$arFields['IBLOCK_ID'],
				$arFields['ID'],
				array(),
				array("CODE" => 'IMAGES')
			);
			$ii = 0;
			while ($file = $dbr->GetNext())
			{

				$ii++;
				$result_image_small = "/upload/fotonews/result_image_small" . $file['VALUE'] . ".jpg";
				$dc_result_image2 = $_SERVER["DOCUMENT_ROOT"] . $result_image_small;
				unlink($dc_result_image2);

				CFile::ResizeImageFile(
					$source = $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($file['VALUE']),
					$result = $dc_result_image2,
					array(
						'width'  => 340,
						'height' => 255
					),
					BX_RESIZE_IMAGE_EXACT,
					array(
						"type"        => "image",
						"file"        => $_SERVER["DOCUMENT_ROOT"] . "/images/small_water2.png",
						"size"        => "real",
						"alpha_level" => 100,
						// 0 - 100
						"position"    => "br"
						//"fill" => 'repeat', // resize | repeat)
					)
				);

				CFile::ResizeImageFile(
					$source = $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($file['VALUE']),
					$result = $_SERVER["DOCUMENT_ROOT"] . "/upload/result.jpg",
					array(
						"width"  => "1024",
						"height" => "768"
					),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					array(
						"type"        => "image",
						"file"        => $_SERVER["DOCUMENT_ROOT"] . "/images/big_water2.png",
						"size"        => "real",
						"alpha_level" => 100,
						// 0 - 100
						"position"    => "br"
						//"fill" => 'repeat', // resize | repeat
					)
				);
				unlink($source);
				rename(
					$_SERVER["DOCUMENT_ROOT"] . "/upload/result.jpg",
					$source
				);


			}
		}
    }
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
		if ($arFields['IBLOCK_ID']==2 || $arFields['IBLOCK_ID']==16)
		{
			// обрезаем и добавляем водяной знак

			$dbr = CIBlockElement::GetProperty(
				$arFields['IBLOCK_ID'],
				$arFields['ID'],
				array(),
				array("CODE" => 'IMAGES')
			);
			$ii = 0;
			while ($file = $dbr->GetNext())
			{

				$ii++;
				$result_image_small = "/upload/fotonews/result_image_small" . $file['VALUE'] . ".jpg";
				$dc_result_image2 = $_SERVER["DOCUMENT_ROOT"] . $result_image_small;
				unlink($dc_result_image2);

				CFile::ResizeImageFile(
					$source = $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($file['VALUE']),
					$result = $dc_result_image2,
					array(
						'width'  => 340,
						'height' => 255
					),
					BX_RESIZE_IMAGE_EXACT,
					array(
						"type"        => "image",
						"file"        => $_SERVER["DOCUMENT_ROOT"] . "/images/small_water2.png",
						"size"        => "real",
						"alpha_level" => 100,
						// 0 - 100
						"position"    => "br",
						//"fill" => 'repeat', // resize | repeat)
					)
				);
				CFile::ResizeImageFile(
					$source = $_SERVER["DOCUMENT_ROOT"] . CFile::GetPath($file['VALUE']),
					$result = $_SERVER["DOCUMENT_ROOT"] . "/upload/result.jpg",
					array(
						"width"  => "1024",
						"height" => "768"
					),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					array(
						"type"        => "image",
						"file"        => $_SERVER["DOCUMENT_ROOT"] . "/images/big_water2.png",
						"size"        => "real",
						"alpha_level" => 100,
						// 0 - 100
						"position"    => "br",
						//"fill" => 'repeat', // resize | repeat
					)
				);
				unlink($source);
				rename(
					$_SERVER["DOCUMENT_ROOT"] . "/upload/result.jpg",
					$source
				);


			}
		}
        //$strf = "";
		// $strf = "";		
		// foreach($arFields['PROPERTY_VALUES'] as $ch => $m)
		// {
			// $strf .= $ch . " => ". $m . "\r\n";
		// }		
		// $ffile = $_SERVER["DOCUMENT_ROOT"]."/upload/fffffffffffffffffff.txt";
		// if(!file_exists($ffile)){
			// $desc = fopen($ffile,"w");
			// fwrite($desc,$strf);
			// fclose($desc);
		// }
		
		//Удаляем папку с изображения с водяными знаками в новостях
		// removeDirectory($_SERVER["DOCUMENT_ROOT"]."/upload/fotonews/");
    }
	// создаем обработчик события "OnBeforeIBlockElementDelete"
function OnBeforeIBlockElementDeleteHandler($ID)
    {
        if($ID==1)
        {
            global $APPLICATION;
            $APPLICATION->throwException("элемент с ID=1 нельзя удалить.");
            return false;
        }
    }
	
	function OnBeforeIBlockElementAddHandler(&$arFields)
    {

    }
	
	// создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {


    }
}


function removeDirectory($dir) {
	if ($objs = glob($dir."/*")) {
	   foreach($objs as $obj) {
		 is_dir($obj) ? removeDirectory($obj) : unlink($obj);
	   }
	}
	rmdir($dir);
}

function PR($o)
{
	$bt =  debug_backtrace();
	$bt = $bt[0];
	$dRoot = $_SERVER["DOCUMENT_ROOT"];
	$dRoot = str_replace("/","\\",$dRoot);
	$bt["file"] = str_replace($dRoot,"",$bt["file"]);
	$dRoot = str_replace("\\","/",$dRoot);
	$bt["file"] = str_replace($dRoot,"",$bt["file"]);
	?>
	<div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;'>
	<div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
	<pre style='padding:10px;'><?print_r($o)?></pre>
	</div>
	<?
	
}

function mmdate($mdate)
{
	//$time = substr($mdate,strlen($mdata)-8,strlen($mdata)-3);
	$time = explode(" ",$mdate);
	$date = explode(".",trim(substr($mdate,0,10)));
	switch($date[1])
	{
		case "01":$month = "января"; break;
		case "02":$month = "февраля"; break;
		case "03":$month = "марта"; break;
		case "04":$month = "апреля"; break;
		case "05":$month = "мая"; break;
		case "06":$month = "июня"; break;
		case "07":$month = "июля"; break;
		case "08":$month = "августа"; break;
		case "09":$month = "сентября"; break;
		case "10":$month = "октября"; break;
		case "11":$month = "ноября"; break;
		case "12":$month = "декабря"; break;
		default: $month = "1";
	}
	if($month == "1"){
		return "1";
	}else{
		return $date[0] . " ". $month ." " . $date[2]. " " . $time[1];
	}
}

//проверка передоваемой даты наступила она или нет
function m_check_date($day,$month,$year)
{
	$date = date('d.m.Y');
	$mass = explode(".",$date);
	if($year < $mass[2])
	{
		return true;
	}
	elseif($year == $mass[2])
	{
		if($month < $mass[1])
		{
			return true;
		}
		elseif($month == $mass[1])
		{
			if($day <= $mass[0])
			{
				return true;
			}
		}
	}
	return false;
}

function get_today_date()
{
	$week=array(0=>"Воскресенье", "Понедельник","Вторник","Среда","Четверг","Пятница","Суббота");
	$cur_month = date('m');
	$cur_day = date('d');
	$cur_year = date('Y');
	switch($cur_month)
	{
		case "01" : $month = "января"; break;
		case "02" : $month = "февраля"; break;
		case "03" : $month = "марта"; break;
		case "04" : $month = "апреля"; break;
		case "05" : $month = "мая"; break;
		case "06" : $month = "июня"; break;
		case "07" : $month = "июля"; break;
		case "08" : $month = "августа"; break;
		case "09" : $month = "сентября"; break;
		case "10" : $month = "октября"; break;
		case "11" : $month = "ноября"; break;
		case "12" : $month = "декабря"; break;
	}
	$st_date = $week[date("w",mktime (0, 0, 0, $cur_month, $cur_day, $cur_year))]. " " . $cur_day . " " . $month ." " . $cur_year . " г.";

	return $st_date;
}

function get_today_date_en()
{
	$week=array(0=>"Sunday", "Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	$cur_month = date('m');
	$cur_day = date('d');
	$cur_year = date('Y');
	switch($cur_month)
	{
		case "01" : $month = "January"; break;
		case "02" : $month = "February"; break;
		case "03" : $month = "March"; break;
		case "04" : $month = "April"; break;
		case "05" : $month = "May"; break;
		case "06" : $month = "June"; break;
		case "07" : $month = "July"; break;
		case "08" : $month = "August"; break;
		case "09" : $month = "September"; break;
		case "10" : $month = "October"; break;
		case "11" : $month = "November"; break;
		case "12" : $month = "December"; break;
	}
	$st_date = $week[date("w",mktime (0, 0, 0, $cur_month, $cur_day, $cur_year))]. " " . $cur_day . " " . $month ." " . $cur_year;

	return $st_date;
}

function get_date($mdate)
{
	/*
		на выходе имеем
		$mass_result["time"]
		$mass_result["day"]
		$mass_result["week_day"]
		$mass_result["month"]
		$mass_result["month_num"]
		$mass_result["year"]
		$mass_result["year_num"]

	*/
    $mass_result["time"] = substr($mdate, strlen($mdate) - 5, strlen($mdate) - 1);  
    $date = explode(".",substr($mdate, 0, 10));
	if(SITE_ID == "s1")
	{
		switch($date[1])
		{
			case "01":$mass_result["month"] = "января"; break;
			case "02":$mass_result["month"] = "февраля"; break;
			case "03":$mass_result["month"] = "марта"; break;
			case "04":$mass_result["month"] = "апреля"; break;
			case "05":$mass_result["month"] = "мая"; break;
			case "06":$mass_result["month"] = "июня"; break;
			case "07":$mass_result["month"] = "июля"; break;
			case "08":$mass_result["month"] = "августа"; break;
			case "09":$mass_result["month"] = "сентября"; break;
			case "10":$mass_result["month"] = "октября"; break;
			case "11":$mass_result["month"] = "ноября"; break;
			case "12":$mass_result["month"] = "декабря"; break;
			default: $mass_result["month"] = "qwe";
		}
	}
	elseif(SITE_ID == "s2")
	{
		switch($date[1])
		{
			case "01":$mass_result["month"] = "January"; break;
			case "02":$mass_result["month"] = "February"; break;
			case "03":$mass_result["month"] = "March"; break;
			case "04":$mass_result["month"] = "April"; break;
			case "05":$mass_result["month"] = "May"; break;
			case "06":$mass_result["month"] = "June"; break;
			case "07":$mass_result["month"] = "July"; break;
			case "08":$mass_result["month"] = "August"; break;
			case "09":$mass_result["month"] = "September"; break;
			case "10":$mass_result["month"] = "October"; break;
			case "11":$mass_result["month"] = "November"; break;
			case "12":$mass_result["month"] = "December"; break;
			default: $mass_result["month"] = "qwe";
		}
	}


    $week=array(0=>"воскресенье", "понедельник","вторник","среда","четверг","пятница","суббота");
    $mass_result["week_day"] = $week[date("w",mktime (0, 0, 0, $date[1], $date[0], $date[2]))];
    $mass_result["month_num"] = $date[1];
    $mass_result["day"] = $date[0];
    $mass_result["year"] = $date[2];

    $mass = str_split($date[2]);
    $mass_result["year_num"] = $mass[count($mass) - 2] . $mass[count($mass) - 1];
    
    return $mass_result;
}


function mobile_detect()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $ipod = strpos($user_agent,"iPod");
    $iphone = strpos($user_agent,"iPhone");
    $android = strpos($user_agent,"Android");
    $symb = strpos($user_agent,"Symbian");
    $winphone = strpos($user_agent,"WindowsPhone");
    $wp7 = strpos($user_agent,"WP7");
    $wp8 = strpos($user_agent,"WP8");
    $operam = strpos($user_agent,"Opera M");
    $palm = strpos($user_agent,"webOS");
    $berry = strpos($user_agent,"BlackBerry");
    $mobile = strpos($user_agent,"Mobile");
    $htc = strpos($user_agent,"HTC_");
    $fennec = strpos($user_agent,"Fennec/");

    if ($ipod || $iphone || $android || $symb || $winphone || $wp7 || $wp8 || $operam || $palm || $berry || $mobile || $htc || $fennec) 
    {
        return true; 
    } 
    else
    {
        return false; 
    }
}

function mobile_iframe($iframe){
	return(str_replace(array(560,315),array(972,733),$iframe));
}

include("/var/www/riadag/data/www/riadag.ru/bitrix/modules/webformat.watermark1/includes/init.php");