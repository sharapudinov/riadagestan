<?php
require __DIR__.'/admin_prefix.php';

use Vettich\AutopostingPlus\DBElementsTable;

IncludeModuleLangFile(__FILE__);

$sTableID = "tbl_posts_".$acc;
$oSort = new CAdminSorting($sTableID, "LAST_MODIFIED", "DESC");
$lAdmin = new CAdminList($sTableID, $oSort);

if($lAdmin->EditAction())
{
	// save $FIELDS
}

if(($arID = $lAdmin->GroupAction()))
{
	if($_REQUEST['action_target']=='selected')
	{
		// selected all id
	}

	foreach($arID as $ID)
	{
		$ID = IntVal($ID);
		if($ID <= 0)
			continue;
		try{
			switch($_REQUEST['action'])
			{
				case 'activate':
					DBElementsTable::update($ID, array('ACTIVE' => 'Y'));
					break;
				case 'deactivate':
					DBElementsTable::update($ID, array('ACTIVE' => 'N'));
					break;
				case "delete":
					DBElementsTable::delete($ID);
					break;
			}
		}
		catch (Exception $e) {
			\Vettich\Autoposting\PostingLogs::addLogFromException($e);
		}
	}
}

$arFields = array(
	'ID' => 'ID',
	'ACTIVE' => GetMessage('vettich_autopostingplus_list_active'),
	'ELEM_ID' => GetMessage('vettich.autopostingplus_field_elem_id'),
	'IBLOCK_ID' => GetMessage('vettich.autopostingplus_field_iblock_id'),
	'TYPE' => GetMessage('vettich.autopostingplus_field_type'),
	'STATUS' => GetMessage('vettich.autopostingplus_field_status'),
	'LAST_MODIFIED' => GetMessage('vettich.autopostingplus_field_last_modified'),
);

$aHeaders = array();

foreach ($arFields as $key => $value)
{
	if(is_array($value))
		$aHeaders[] = array('id'=>$key, 'content'=>$value['content'], 'sort'=>$key, 'default'=>$value['default']);
	else
		$aHeaders[] = array('id' => $key, 'content' => $value, 'sort' => $key, 'default' => true);
}
$lAdmin->AddHeaders($aHeaders);

$rsList = DBElementsTable::GetList(array(
	'select' => array('ID', 'ACTIVE', 'ELEM_ID', 'IBLOCK_ID', 'TYPE', 'STATUS', 'LAST_MODIFIED'),
	'filter' => array(),
	'order' => array(($by?:'ID') => ($order?:'desc')),
	'count_total' => true,
));

$navResult = new CAdminResult($rsList, $sTableID);
$navResult->NavStart();
$lAdmin->NavText($navResult->GetNavPrint());
while($ar = $navResult->NavNext())
	$arList[] = $ar;

$edit_action_url = "vettich_autopostingplus_detail.php";

CModule::IncludeModule('iblock');
foreach($arList as $list)
{
	$row =& $lAdmin->AddRow($list['ID'], $list);
	$row->AddViewField('ID', '<a href="'.$edit_action_url.'?ID='.$list['ID'].'">'.$list['ID'].'</a>');
	$row->AddViewField('ACTIVE', $row->arRes['ACTIVE'] == 'Y' ? GetMessage('YES') : GetMessage('NO'));
	switch($row->arRes['STATUS'])
	{
		case 'READY':
			$row->AddViewField('STATUS', GetMessage('vettich.autopostingplus_list_status_ready'));
			break;
		case 'OK':
			$row->AddViewField('STATUS', GetMessage('vettich.autopostingplus_list_status_ok'));
			break;
	}
	switch($row->arRes['TYPE'])
	{
		case 'ADD':
			$row->AddViewField('TYPE', GetMessage('vettich.autopostingplus_list_type_add'));
			break;
		case 'EDIT':
			$row->AddViewField('TYPE', GetMessage('vettich.autopostingplus_list_type_edit'));
			break;
		case 'DELETE':
			$row->AddViewField('TYPE', GetMessage('vettich.autopostingplus_list_type_delete'));
			break;
	}
	if(!empty($row->arRes['IBLOCK_ID']))
	{
		$b = CIBlock::GetByID($row->arRes['IBLOCK_ID'])->Fetch();
		$row->AddViewField('IBLOCK_ID', '['.$row->arRes['IBLOCK_ID'].'] '.$b['NAME']);
		// $row->AddViewField('IBLOCK_ID', '<a href="iblock_edit.php?ID='.$row->arRes['IBLOCK_ID'].'&type='.$b['IBLOCK_TYPE_ID'].'">['.$row->arRes['IBLOCK_ID'].'] '.$b['NAME'].'</a>');
	}

	$arActions = Array(
		array(
			"TEXT"=> $row->arRes['ACTIVE'] == 'Y' ? GetMessage('vettich.autopostingplus_list_deactivate') : GetMessage('vettich.autopostingplus_list_activate'),
			"ACTION"=>$lAdmin->ActionDoGroup($list['ID'], $row->arRes['ACTIVE'] == 'Y' ? 'deactivate' : 'activate'),
		),
		array(
			"TEXT"=> GetMessage('vettich.autopostingplus_list_posting'),
			"ACTION"=>$lAdmin->ActionDoGroup($list['ID'], 'posting'),
		),
		array('SEPARATOR' => true),
		array(
			"ICON"=>"edit",
			"DEFAULT"=>true,
			"TEXT"=>GetMessage("vettich.autopostingplus_list_detail"),
			"ACTION"=>$lAdmin->ActionRedirect($edit_action_url.'?ID='.$list['ID']),
		),
		array(
			"ICON"=>"delete",
			"TEXT"=>GetMessage("vettich.autopostingplus_list_delete"),
			"ACTION"=>"if(confirm('".GetMessage("vettich.autopostingplus_list_delete_confirm")."')) ".$lAdmin->ActionDoGroup($list['ID'], "delete")
		),
	);
	$row->AddActions($arActions);
}

$lAdmin->AddGroupActionTable(Array(
	"delete"=>true,
));
$lAdmin->arActions['activate'] = GetMessage('vettich.autopostingplus_list_activate');
$lAdmin->arActions['deactivate'] = GetMessage('vettich.autopostingplus_list_deactivate');
$lAdmin->AddAdminContextMenu();
$lAdmin->CheckListMode();

$pageTitle = GetMessage('vettich.autopostingplus_list_title');
$APPLICATION->SetTitle($pageTitle);

require_once ($DOCUMENT_ROOT.BX_ROOT."/modules/main/include/prolog_admin_after.php");

$lAdmin->DisplayList();

\VOptions::showCSS();
?>
<div class="voptions-description" style="font-size:small">
<?=GetMessage('vettich.autopostingplus_list_description')?>
</div>
<?

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
