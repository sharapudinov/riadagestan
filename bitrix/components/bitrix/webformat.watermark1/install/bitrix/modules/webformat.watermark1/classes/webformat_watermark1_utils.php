<?php
if(!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)){die();}

IncludeModuleLangFile( __FILE__ );

class WebformatWatermark1Utils{
	const LANG_PREFIX = 'WEBFORMAT_WATERMARK1_';
	public function __construct(){}
	
	static function PackArray(&$array, $indent = 0){
		if(is_array($array) && !(bool)$array){return 'array()';}
		if(!(bool)$array || !is_array($array)){return '""';}
		$packet = 'array(';
			foreach($array as $key => $value){
				if(is_string($value) && ((string)(int)$value !== $value) && !in_array($value, array('true', 'false'))){$value = '"'.$value.'"';}
				if((string)(int)$key == (string)$key){$key = (int)$key;
				}else{$key = '"'.$key.'"';}
				$packet .= "\n".str_repeat("\t", $indent + 1).$key.' => '.(is_array($value) ? (self::PackArray($value, $indent + 1)) : $value).',';
			}
			$packet = rtrim($packet, ',');
		$packet .= "\n".str_repeat("\t", $indent).')';
		return $packet;
	}
	
	static function GetOptions(){
		if(file_exists($optionsFile = rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/includes/options.php')){
			include($optionsFile);
		}else{
			include(rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/includes/defaultOptions.php');
		}
		return ${'options'};
	}

	static function SaveOptions($data){
		if(!isset($data['webformat_watermark1']) || !isset($data['webformat_watermark1']['iblocks']) || (!isset($data['webformat_watermark1']['props_standart']) && !isset($data['webformat_watermark1']['props_extra']))){
			ShowError(GetMessage(self::LANG_PREFIX.'OPTIONS_INCORRECT_SET'));
			return false;
		} 
		$data = $data['webformat_watermark1'];
		
		//Iblock IDs
			$iblockIDs = $data['iblocks'];
			if(!is_array($iblockIDs)){$iblockIDs = array($iblockIDs);}
			if(in_array(-1,$iblockIDs)){$iblockIDs = array(-1);}
			if(in_array(0,$iblockIDs)){$iblockIDs = array();}
			$data['iblocks'] = $iblockIDs;
		//---End---Iblock IDs

		//Property Codes
			$propertyCodes = trim($data['props_extra']);
			if((bool)$propertyCodes){
				$propertyCodes = explode("\n", $propertyCodes);
				foreach($propertyCodes as $key => $value){
					if(!(bool)trim($value)){unset($propertyCodes[$key]);
					}else{$propertyCodes[$key] = trim($value);}
				}
			}else{$propertyCodes = array();}
			if(!isset($data['props_standart'])){$data['props_standart'] = array();}
			$propertyCodes = array_merge($propertyCodes, $data['props_standart']);
			unset($data['props_standart'], $data['props_extra']);
			$data['props'] = $propertyCodes;
		//---End---Property Codes

		//Filter parameters
			$filter =& $data['filter'];
			
			if(!isset($filter['type']) || !(bool)$filter['type']){
				ShowError(GetMessage(self::LANG_PREFIX.'OPTIONS_INCORRECT_FILTER_TYPE'));
				return false;
			}
			$filter['position'] = $filter['position']['vertical'].$filter['position']['horizontal'];
			$filter['name'] = 'watermark';

			if($filter['type'] == 'image'){
				$filter['coefficient'] = $filter['coefficient'] / 100;
				if($filter['coefficient'] != 0){$filter['fill'] = 'resize';}
			}


			if((bool)$filter['file']){$filter['file'] = rtrim($_SERVER['DOCUMENT_ROOT'], '/') .$filter['file'];}

			if((bool)$filter['font']){ $filter['font'] = rtrim($_SERVER['DOCUMENT_ROOT'], '/') .$filter['font'];
			}else{$filter['font'] = rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/fonts/opensans-condensed/opensans-condlight-webfont.ttf';}
			$filter['color'] = trim($filter['color'], '#');
		//---End---Filter parameters

		$scripts = '<?php if(!defined("B_PROLOG_INCLUDED") || (B_PROLOG_INCLUDED !== true)){die();}'."\n";
		$scripts .= '$options = '.self::PackArray($data).';';
		if(!file_put_contents(rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/includes/options.php', $scripts)){
			ShowError(GetMessage(self::LANG_PREFIX.'OPTIONS_CANT_SAVE'));
			return false;
		}else{
			chmod(rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/includes/options.php', BX_FILE_PERMISSIONS);
		}
		ShowNote(GetMessage(self::LANG_PREFIX.'OPTIONS_SUCCESS'));
		return true;
	}
	static function WatermarkFile($filePathOrID){
		global $DB;
		//include(rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/includes/options.php');
		$options = self::GetOptions();
		
		if(!(bool)($httpSrc = $filePathOrID)){return;}
		$mimes = array('gif' => 'gif', 'jpeg' => 'jpg', 'png' => 'png'); //search part => extension
		
		if(substr($filePathOrID, 0, strlen($_SERVER['DOCUMENT_ROOT'])) == $_SERVER['DOCUMENT_ROOT']){
			$httpSrc = substr($filePathOrID, strlen($_SERVER['DOCUMENT_ROOT']));
		}
		
		if((string)(int)$httpSrc == (string)$httpSrc){$httpSrc = CFile::GetPath($httpSrc);}// Path to file from the site root
		$httpSrc = ltrim($httpSrc, '/');

		if((bool)$httpSrc) {
			$phpSrc = rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/'.$httpSrc;
			$imgData = getimagesize($phpSrc);
			$srcW = $imgData[0];
			$srcH = $imgData[1];
			$inputMime = strtolower($imgData['mime']);
		}else{return;}

		//Define file extension
			$fileExt = false;
			foreach($mimes as $mimeSearchPart => $fileExtTemp){
				if(strpos($inputMime, $mimeSearchPart) !== false){
					$fileExt = $fileExtTemp; break;
				}
			}
		//---End---Define file extension

		if((bool)$fileExt){
			//Check watermark was added earlier
				$query = 'SELECT wf_id FROM webformat_watermark1 WHERE crc32 = CRC32("'.$httpSrc.'") AND name = "'.basename($httpSrc).'" AND http_dir = "'.dirname($httpSrc).'"';
				$dbresult = $DB->query($query, false);
				if((bool)$dbresult->SelectedRowsCount()){return;}
			//---End---Check watermark was added earlier


			switch($fileExt){
				case 'jpg': $srcRes = imagecreatefromjpeg($phpSrc); break;
				case 'png': $srcRes = imagecreatefrompng($phpSrc); break;
				case 'gif': $srcRes = imagecreatefromgif($phpSrc); break;
			}

			if((bool)CFile::WaterMark($srcRes, $options['filter'])){
				switch($fileExt){
					case 'jpg': imagejpeg($srcRes, $phpSrc, 90); break;
					case 'png': imagepng($srcRes, $phpSrc); break;
					case 'gif': imagegif($srcRes, $phpSrc); break;
				}

				//Save file info to watermark table (to prevent re-watermark)
					$query = 'INSERT INTO webformat_watermark1(http_dir, name, crc32) VALUES("'.dirname($httpSrc).'", "'.basename($httpSrc).'", CRC32("'.$httpSrc.'"))';
					$DB->query($query, false);
				//---End---Save file info to watermark table (to prevent re-watermark)
			}
		}
	}


	static function CreateWatermark(&$element) {
		global $APPLICATION;
		global $DB;

		//include(rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/bitrix/modules/webformat.watermark1/includes/options.php');
		$options = self::GetOptions();
		
		if(in_array(-1, $options['iblocks'])){return;}
		if(!(bool)$options['props']){return;}

		if(!(bool)$options['iblocks'] || in_array((int)$element['IBLOCK_ID'], $options['iblocks'])) {
			if((bool)array_intersect(array('DETAIL_PICTURE', 'PREVIEW_PICTURE'), $options['props'])){
				$res = CIBlockElement::GetList(array(), array('ID' => $element['ID'], 'IBLOCK_ID' => $element['IBLOCK_ID']), false, false, array('ID', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));
				if($fields = $res->GetNext()){
					if(!is_array($fields['DETAIL_PICTURE'])){
						$fields['DETAIL_PICTURE'] = CFile::GetFileArray((int)$fields['DETAIL_PICTURE']);
					}
					if(!is_array($fields['PREVIEW_PICTURE'])){
						$fields['PREVIEW_PICTURE'] = CFile::GetFileArray((int)$fields['PREVIEW_PICTURE']);
					}
				}
				
				if(in_array('DETAIL_PICTURE', $options['props'])){self::WatermarkFile($fields['DETAIL_PICTURE']['SRC']);}
				if(in_array('PREVIEW_PICTURE', $options['props'])){self::WatermarkFile($fields['PREVIEW_PICTURE']['SRC']);}
			}
			
			foreach($options['props'] as $propertyCode){
				$res = CIBlockElement::GetProperty($element['IBLOCK_ID'], $element['ID'], array(), array('CODE' => $propertyCode));
				while($property = $res->GetNext()){
					self::WatermarkFile($property['VALUE']);
				}
			}
		}
	}
}