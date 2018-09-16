<?
/**
 * Модуль shopolia.images (Продвинутое поле для инфоблоков для загрузки фоток)
 */


global $MESS, $DB;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-18);
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

Class shopolia_images extends CModule {
	var $MODULE_ID = "shopolia.images";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;

	// Описание модуля
	function shopolia_images () {
        global $APPLICATION;
		$arModuleVersion = array();
		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");
		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		} else {
			$this->MODULE_VERSION = SHOPOLIA_IMAGE_VERSION;
			$this->MODULE_VERSION_DATE = SHOPOLIA_IMAGES_VERSION_DATE;
		}

        $this->MODULE_NAME = GetMessage("SHOPOLIA_IMAGES_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("SHOPOLIA_IMAGES_MODULE_DESC");
		$this->PARTNER_NAME = "Shopolia.com"; 
		$this->PARTNER_URI = "http://shopolia.com"; 
	}

	// Выполнение установочных SQL-запросов, привязка к другим модулям
	function InstallDB($arParams = array()) {
		RegisterModule($this->MODULE_ID);
        RegisterModuleDependences("iblock", "OnIBlockPropertyBuildList", $this->MODULE_ID, "CShopoliaImagesProperty", "GetUserTypeDescription");
        RegisterModuleDependences("iblock", "OnBeforeIBlockPropertyAdd", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIBlockPropertyHandler");
        RegisterModuleDependences("iblock", "OnBeforeIBlockPropertyUpdate", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIBlockPropertyHandler");
        RegisterModuleDependences("iblock", "OnAfterIblockElementAdd", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIblockElementHandler");
        RegisterModuleDependences("iblock", "OnAfterIblockElementUpdate", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIblockElementHandler");
        COption::SetOptionString($this->MODULE_ID, "jquery_link", "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js");
        COption::SetOptionString($this->MODULE_ID, "upload_dir", "/upload/ajax_uploads/");
		return true;
	}
    
    function InstallFiles ($arParams = array()) {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/admin', $_SERVER['DOCUMENT_ROOT']."/bitrix/admin", true, true);
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/js', $_SERVER['DOCUMENT_ROOT']."/bitrix/js/".$this->MODULE_ID, true, true);
    }

	// Удаление базы данных и зависимостей от других модулей
	function UnInstallDB($arParams = array()) {
        UnRegisterModuleDependences("iblock", "OnIBlockPropertyBuildList", $this->MODULE_ID, "CShopoliaImagesProperty", "GetUserTypeDescription");
        UnRegisterModuleDependences("iblock", "OnBeforeIBlockPropertyAdd", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIBlockPropertyHandler");
        UnRegisterModuleDependences("iblock", "OnBeforeIBlockPropertyUpdate", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIBlockPropertyHandler");
        UnRegisterModuleDependences("iblock", "OnAfterIblockElementAdd", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIblockElementHandler");
        UnRegisterModuleDependences("iblock", "OnAfterIblockElementUpdate", $this->MODULE_ID, "CShopoliaImagesProperty", "OnAfterIblockElementHandler");
		COption::RemoveOption($this->MODULE_ID); // удаляем все настройки
		UnRegisterModule($this->MODULE_ID);
		return true;
	}
    
    function UnInstallFiles ($arParams = array()) {
        DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/admin', $_SERVER['DOCUMENT_ROOT']."/bitrix/admin"); 
        $this->deleteDirectory($_SERVER['DOCUMENT_ROOT']."/bitrix/js/".$this->MODULE_ID);
    }
    
    // рекурсивное удаление директории
    function deleteDirectory($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!$this->deleteDirectory($dir . "/" . $item)) return false;
            };
        }
        return rmdir($dir);
    }
    
	// Процедуры, выполняемые сразу после запуска установки модуля
	function DoInstall() {
		global $DOCUMENT_ROOT, $APPLICATION, $MESS;
		$step = intval($_POST['step']);
        $this->InstallDB(); // ставим базу
        $this->InstallFiles(); // ставим базу
        $GLOBALS["errors"] = $this->errors;
        $APPLICATION->IncludeAdminFile(GetMessage("SHOPOLIA_IMAGES_INSTALL_TITLE"), $DOCUMENT_ROOT."/bitrix/modules/".$this->MODULE_ID."/install/install_ready.php");
	}

	// Процедуры, выполняемые сразу после запуска деинсталляции модуля
	function DoUninstall() {
		global $DOCUMENT_ROOT, $APPLICATION;
		$this->UnInstallDB();
        $this->UnInstallFiles();
		$APPLICATION->IncludeAdminFile(GetMessage("SHOPOLIA_IMAGES_UNINSTALL_TITLE"), $DOCUMENT_ROOT."/bitrix/modules/".$this->MODULE_ID."/install/uninstall_ready.php");
	}
}
?>
