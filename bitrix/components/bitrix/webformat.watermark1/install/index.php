<?php
IncludeModuleLangFile(__FILE__);

if(class_exists('webformat_watermark1')){return;}

Class webformat_watermark1 extends CModule{
	const MODULE_ID = 'webformat.watermark1';

	var $MODULE_ID = 'webformat.watermark1';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS;
	var $PARTNER_NAME;
	var $PARTNER_URI;

	private $langPrefix;
	private $phpRoot;

	function __construct(){
		$arModuleVersion = array();
		$this->MODULE_ID = 'webformat.watermark1';
		$this->langPrefix = strtoupper(__CLASS__).'_';

		include(dirname(__FILE__)."/version.php");
		if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)){
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}

		$this->PARTNER_NAME = GetMessage('WEBFORMAT_WATERMARK1_PARTNER_NAME'); // $this->langPrefix can't be passed as a prefix to the GetMessage() function. This is a bitrix "magic"
		$this->PARTNER_URI = 'http://www.webformat.ru';
		$this->MODULE_GROUP_RIGHTS = 'Y';

		$this->MODULE_NAME = GetMessage($this->langPrefix.'MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage($this->langPrefix.'MODULE_DESCRIPTION');

		$this->phpRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/').'/';
	}

	function DoInstall(){
		if(!IsModuleInstalled(self::MODULE_ID)){
			$this->InstallFiles();
			$this->InstallDB();
			RegisterModule(self::MODULE_ID);
		}
	}

	function DoUninstall(){
		$this->UnInstallFiles();
		$this->UnInstallDB();
		UnRegisterModule(self::MODULE_ID);
	}

	public function MyVarDump($var, $exit = true){ //Optional method, only for convenient debug
		echo '<pre style="font-size:15px;">';
			var_dump($var);
		echo '</pre>';
		if($exit){exit;}
	}

	function InstallEvents(){return true;}
	function UnInstallEvents(){return true;}

	function InstallDB(){
		global $DB;
		$query = '
			CREATE TABLE IF NOT EXISTS webformat_watermark1(
				wf_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
				http_dir VARCHAR(255) NOT NULL,
				name VARCHAR(100) NOT NULL,
				crc32 INT UNSIGNED NOT NULL,
				KEY crc32index(crc32)
			) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COLLATE cp1251_general_ci
		';
		$DB->query($query, false);
		return true;
	}
	function UnInstallDB(){
		global $DB;
		$query = 'DROP TABLE IF EXISTS webformat_watermark1';
		$DB->query($query, false);
		return true;
	}

	function InstallFiles(){
		if($fRes = $this->PreparePHPFile($this->phpRoot.'bitrix/php_interface/init.php', GetMessage($this->langPrefix.'FILES_INIT_CREATION_FAILURE'))){
			fputs($fRes,"\n".'include("'.$this->phpRoot.'bitrix/modules/'.self::MODULE_ID.'/includes/init.php");');
			fclose($fRes);
			return true;
		}
		return false;
	}

	private function PreparePHPFile($path, $errorMsg = false){
		if(!(bool)$errorMsg){$errorMsg = 'Can\'t create file "'.$path.'"!';}
		if(!file_exists($path)){
			if($fRes = fopen($path, 'a+')){fputs($fRes,'<?php '); return $fRes;
			}else{ShowError($errorMsg); return false;}
		}

		$content = trim(file_get_contents($path));
		if(substr($content, strlen($content) - 2) == '?>'){
			file_put_contents($path, substr($content, 0, strlen($content) - 2));
		}
		if(!($fRes = fopen($path, 'a+'))){ShowError($errorMsg); return false;}
		return $fRes;
	}

	function UnInstallFiles(){
		$initFile = $this->phpRoot.'bitrix/php_interface/init.php';
		if(file_exists($initFile) && (bool)($cleanedContent = $this->InitCleanedContent(file_get_contents($initFile)))){
			$cleanedContent = trim($cleanedContent);
			if(($cleanedContent == '<?php') || ($cleanedContent == '<?')){
				return unlink($initFile);
			}else{
				return (bool)file_put_contents($initFile, $cleanedContent);
			}
		}
		return true;
	}

	private function InitCleanedContent($initContent){
		//$regEx = "/([\s\S]*)include[^;]*".self::MODULE_ID."\/includes\/init.php[^;]*;([\s\S]*)/";
		$regEx = "/\ninclude[^;]*".self::MODULE_ID."\/includes\/init.php[^;]*;/";
		//$cleanedContent = preg_replace_callback($regEx, create_function('$m', 'return (rtrim($m[1])."\n".ltrim($m[2]));'), $initContent, -1, $count);
		$cleanedContent = preg_replace($regEx, '', $initContent, -1, $count);
		if((bool)$count){return $cleanedContent;}
		return false;
	}

}