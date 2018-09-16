<?
IncludeModuleLangFile(__FILE__);
Class vettich_autopostingplus extends CModule
{
	const MODULE_ID = 'vettich.autopostingplus';
	var $MODULE_ID = 'vettich.autopostingplus'; 
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_ROOT_DIR = dirname(__DIR__);
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("vettich.autopostingplus_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("vettich.autopostingplus_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("vettich.autopostingplus_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("vettich.autopostingplus_PARTNER_URI");
	}

	function InstallDB($arParams = array())
	{
		$lib = $this->MODULE_ROOT_DIR.'/lib';
		include $lib.'/dbase.php';

		include $lib.'/dboption.php';
		if(!Vettich\AutopostingPlus\DBOptionTable::createTable())
			return false;

		include $lib.'/dbelements.php';
		if(!Vettich\AutopostingPlus\DBElementsTable::createTable())
			return false;

		include $lib.'/dbcategory.php';
		if(!Vettich\AutopostingPlus\DBCategoryTable::createTable())
			return false;

		include $lib.'/dbcategoryelems.php';
		if(!Vettich\AutopostingPlus\DBCategoryElemsTable::createTable())
			return false;

		$plib = $lib.'/posts';
		foreach($this->getPosts() as $post)
		{
			$fdb = $plib.'/'.$post.'/db.php';
			$fdbopt = $plib.'/'.$post.'/dboption.php';
			if(file_exists($fdb) && file_exists($fdbopt))
			{
				include $fdb; include $fdbopt;
				$db = 'Vettich\AutopostingPlus\Posts\\'.$post.'\DBTable';
				$dbopt = 'Vettich\AutopostingPlus\Posts\\'.$post.'\DBOptionTable';
				if(!$db::createTable() or !$dbopt::createTable())
					return false;
			}
		}

		$def_options = array(
			// pending
			'is_enable_agent' => 'Y',
			// googleplus
			'is_googleplus_enable' => 'Y',
			'googleplus_log_success' => 'N',
			'googleplus_log_error' => 'Y',
			// pinterest
			'is_pinterest_enable' => 'Y',
			'pinterest_log_success' => 'N',
			'pinterest_log_error' => 'Y',
			// mymailru
			'is_mymailru_enable' => 'Y',
			'mymailru_log_success' => 'N',
			'mymailru_log_error' => 'Y',
		);
		foreach($def_options as $k => $v)
		{
			COption::SetOptionString('vettich.autoposting', $k, $v);
		}

		return true;
	}

	function UnInstallDB($arParams = array())
	{
		COption::RemoveOption($this->MODULE_ID);
		if (!$arParams['savedata'] && \CModule::IncludeModule(self::MODULE_ID))
		{
			if(!Vettich\AutopostingPlus\DBOptionTable::dropTable())
				return false;

			if(!Vettich\AutopostingPlus\DBElementsTable::dropTable())
				return false;

			if(!Vettich\AutopostingPlus\DBCategoryTable::dropTable())
				return false;

			if(!Vettich\AutopostingPlus\DBCategoryElemsTable::dropTable())
				return false;

			$plib = $this->MODULE_ROOT_DIR.'/lib/posts';
			foreach($this->getPosts() as $post)
			{
				$fdb = $plib.'/'.$post.'/db.php';
				$fdbopt = $plib.'/'.$post.'/dboption.php';
				if(file_exists($fdb) && file_exists($fdbopt))
				{
					include $fdb; include $fdbopt;
					$db = 'Vettich\AutopostingPlus\Posts\\'.$post.'\DBTable';
					$dbopt = 'Vettich\AutopostingPlus\Posts\\'.$post.'\DBOptionTable';
					if(!$db::dropTable() or !$dbopt::dropTable())
						return false;
				}
			}
		}
		return true;
	}

	function InstallEvents()
	{
		RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CVettichAutopostingplus', 'OnBuildGlobalMenu', 1000);
		RegisterModuleDependences('main', 'OnPageStart', self::MODULE_ID, 'CVettichAutopostingplus', 'OnPageStart', 1000);
		RegisterModuleDependences('iblock', 'OnAfterIBlockElementUpdate', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnAfterIBlockElementUpdate', 1000);
		RegisterModuleDependences('iblock', 'OnAfterIBlockElementDelete', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnAfterIBlockElementDelete', 1000);
		RegisterModuleDependences('vettich.autoposting', 'OnBuildPostsParams', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnBuildPostsParams', 1000);
		RegisterModuleDependences('vettich.autoposting', 'OnSavePostsParams', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnSavePostsParams', 1000);
		RegisterModuleDependences('vettich.autoposting', 'OnBeforePost', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnBeforePost', 1000);
		RegisterModuleDependences('vettich.autoposting', 'OnBuildOptions', self::MODULE_ID, 'CVettichAutopostingplus', 'OnBuildOptions', 1000);
		RegisterModuleDependences('vettich.autoposting', 'OnGetPosts', self::MODULE_ID, '\Vettich\AutopostingPlus\Event', 'OnGetPosts', 1000);

		return true;
	}

	function UnInstallEvents()
	{
		UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CVettichAutopostingplus', 'OnBuildGlobalMenu');
		UnRegisterModuleDependences('main', 'OnPageStart', self::MODULE_ID, 'CVettichAutopostingplus', 'OnPageStart');
		UnRegisterModuleDependences('iblock', 'OnAfterIBlockElementUpdate', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnAfterIBlockElementUpdate');
		UnRegisterModuleDependences('iblock', 'OnAfterIBlockElementDelete', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnAfterIBlockElementDelete');
		UnRegisterModuleDependences('vettich.autoposting', 'OnBuildPostsParams', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnBuildPostsParams');
		UnRegisterModuleDependences('vettich.autoposting', 'OnSavePostsParams', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnSavePostsParams');
		UnRegisterModuleDependences('vettich.autoposting', 'OnBeforePost', self::MODULE_ID, '\\Vettich\\AutopostingPlus\\PostingOptions', 'OnBeforePost');
		UnRegisterModuleDependences('vettich.autoposting', 'OnBuildOptions', self::MODULE_ID, 'CVettichAutopostingplus', 'OnBuildOptions');
		UnRegisterModuleDependences('vettich.autoposting', 'OnGetPosts', self::MODULE_ID, '\Vettich\AutopostingPlus\Event', 'OnGetPosts');

		return true;
	}

	function InstallFiles($arParams = array())
	{
		CopyDirFiles($this->MODULE_ROOT_DIR."/install/bitrix",$_SERVER["DOCUMENT_ROOT"]."/bitrix", true, true);
		return true;
	}

	function UnInstallFiles()
	{
		DeleteDirFiles($this->MODULE_ROOT_DIR."/install/bitrix/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
		DeleteDirFiles($this->MODULE_ROOT_DIR."/install/bitrix/js/vettich.autopostingplus", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/vettich.autopostingplus");
		DeleteDirFiles($this->MODULE_ROOT_DIR."/install/bitrix/css/vettich.autopostingplus", $_SERVER["DOCUMENT_ROOT"]."/bitrix/css/vettich.autopostingplus");
		DeleteDirFiles($this->MODULE_ROOT_DIR."/install/bitrix/images/vettich.autopostingplus", $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/vettich.autopostingplus");
		return true;
	}

	function DoInstall()
	{
		global $step, $APPLICATION;
		if($this->InstallDB()
			&&$this->InstallFiles()
			&& $this->InstallEvents())
		{
			RegisterModule(self::MODULE_ID);
			CAgent::AddAgent('CVettichAutopostingplus::agent();', self::MODULE_ID, 'N', 60);
			// $APPLICATION->IncludeAdminFile(GetMessage("VPOSTINGPLUS_INSTALL_TITLE"), $this->MODULE_ROOT_DIR."/install/step1.php");
			return true;
		}
		return false;
	}

	function DoUninstall()
	{
		global $step, $APPLICATION;
		$step = IntVal($step);
		if($step<2)
		{
			$APPLICATION->IncludeAdminFile(GetMessage("VPOSTINGPLUS_UNINSTALL_TITLE"), $this->MODULE_ROOT_DIR."/install/unstep1.php");
		}
		elseif($step==2)
		{
			if($this->UnInstallDB(array('savedata' => $_REQUEST['savedata']))
				&& $this->UnInstallFiles()
				&& $this->UnInstallEvents())
			{
				CAgent::RemoveModuleAgents(self::MODULE_ID);
				UnRegisterModule(self::MODULE_ID);
				return true;
			}
			return false;
		}
	}

	function getPosts()
	{
		$posts = array();
		$_dir_name = $this->MODULE_ROOT_DIR.'/lib/posts/';
		$_dir = scandir($_dir_name);
		if($_dir !== false)
			foreach($_dir as $v)
				if($v != '.' && $v != '..' && is_dir($_dir_name.$v))
					$posts[] = $v;
		return $posts;
	}
}
?>
