<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

if(CModule::IncludeModule('vettich.autopostingplus'))
{
	if($_GET['method'] == 'check_login')
	{
		$email = htmlspecialchars($_GET['email']);
		$pass = htmlspecialchars($_GET['pass']);
		if($id = Vettich\AutopostingPlus\Posts\googleplus\Posting::is_login_correct($email, $pass))
		{
			$arComm = Vettich\AutopostingPlus\Posts\googleplus\Posting::get_pages();
			echo json_encode(array($id, $arComm));
		}
		else
			echo 0;
	}
	exit;
}
