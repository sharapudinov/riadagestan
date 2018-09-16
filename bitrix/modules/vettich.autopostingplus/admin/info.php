<?
require __DIR__.'/admin_prefix.php';
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
IncludeModuleLangFile(__FILE__);

$APPLICATION->SetTitle(GetMessage('VCH_PLUS_INFO_TITLE'));
$arTabs = array(
	array(
		'DIV' => 'TAB1',
		'TAB' => GetMessage('VCH_PLUS_INFO_TAB'),
		'TITLE' => GetMessage('VCH_PLUS_INFO_TAB_TITLE'),
	),
);

$tabControl = new CAdminTabControl("tabControlPlusInfo", $arTabs, true, true);
$tabControl->Begin();
$tabControl->BeginNextTab();

echo GetMessage('VCH_PLUS_INFO_THIS_INSTALL');
echo '<br>';

$module_id = 'vettich.autoposting';
if(is_dir(_module_path($module_id, 'bitrix')) or is_dir(_module_path($module_id, 'local')))
{
	echo GetMessage('VCH_PLUS_INFO_NEED_INSTALL');
}
else
{
	echo GetMessage('VCH_PLUS_INFO_NEED_UPDATE');
}
echo '<br>';
echo GetMessage('VCH_PLUS_INFO_THIS_INSTALL_END');

$tabControl->End();

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");

function _module_path($module_id, $bxroot)
{
	return $_SERVER['DOCUMENT_ROOT']."/$bxroot/modules/$module_id/";
}
