<?
$_f = '/pinterest_callback.php';
$_d = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/vettich.autopostingplus/admin';
if(!is_dir($_d))
	$_d = $_SERVER['DOCUMENT_ROOT'].'/local/modules/vettich.autopostingplus/admin';
include $_d.$_f;
