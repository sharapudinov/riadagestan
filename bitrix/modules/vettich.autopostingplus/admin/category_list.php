<?php
require __DIR__.'/admin_prefix.php';

IncludeModuleLangFile(__FILE__);

$db = 'Vettich\AutopostingPlus\DBCategoryTable';
$sTableID = 'vch_applus_category_list';
$oSort = new CAdminSorting($sTableID, 'LAST_MODIFIED', 'DESC');
$lAdmin = new CAdminList($sTableID, $oSort);

if($lAdmin->EditAction())
{
	// save $FIELDS
}

if(($arID = $lAdmin->GroupAction()))
{
	if($_REQUEST['action_target']=='selected')
	{
		$rs = $db::GetList(array(
			'select' => 'ID',
		));
		$arID = array();
		while($ar = $rs->fetch())
			$arID[] = $ar['ID'];
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
					$db::update($ID, array('ACTIVE' => 'Y'));
					break;
				case 'deactivate':
					$db::update($ID, array('ACTIVE' => 'N'));
					break;
				case 'delete':
					$db::delete($ID);
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
	'NAME' => GetMessage('vettich_autopostingplus_list_NAME'),
	'ACTIVE' => GetMessage('vettich_autopostingplus_list_active'),
	'ELEM_COUNT' => GetMessage('vettich.autopostingplus_field_elem_count'),
	'IBLOCK_ID' => GetMessage('vettich.autopostingplus_field_iblock_id'),
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

$rsList = $db::GetList(array(
	'select' => array('ID', 'NAME', 'ACTIVE', 'ELEM_COUNT', 'IBLOCK_ID', 'LAST_MODIFIED', 'SUBCATEGORIES'),
	'filter' => array(),
	'order' => array(($by?:'ID') => ($order?:'desc')),
	'count_total' => true,
));

$navResult = new CAdminResult($rsList, $sTableID);
$navResult->NavStart();
$lAdmin->NavText($navResult->GetNavPrint());
while($ar = $navResult->NavNext())
	$arList[] = $ar;

$edit_action_url = 'vettich_autopostingplus_category_detail.php';

CModule::IncludeModule('iblock');
foreach($arList as $list)
{
	$row =& $lAdmin->AddRow($list['ID'], $list);
	$row->AddViewField('NAME', '<a href="'.$edit_action_url.'?ID='.$list['ID'].'">'.$list['NAME'].'</a>');
	$row->AddViewField('ACTIVE', $row->arRes['ACTIVE'] == 'Y' ? GetMessage('YES') : GetMessage('NO'));
	if(!empty($list['IBLOCK_ID']))
	{
		$b = CIBlock::GetByID($list['IBLOCK_ID'])->Fetch();
		$row->AddViewField('IBLOCK_ID', '['.$list['IBLOCK_ID'].'] '.$b['NAME']);
		// $row->AddViewField('IBLOCK_ID', '<a href="iblock_edit.php?ID='.$row->arRes['IBLOCK_ID'].'&type='.$b['IBLOCK_TYPE_ID'].'">['.$row->arRes['IBLOCK_ID'].'] '.$b['NAME'].'</a>');
		$arFilter = array(
			'IBLOCK_ID' => $list['IBLOCK_ID'],
		);
		if(!empty($list['SUBCATEGORIES']))
		{
			$arFilter['SECTION_ID'] = $list['SUBCATEGORIES'];
			$arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
		}
		$totalCnt = CIBlockElement::GetList(
			array(), //sort
			$arFilter,
			array(), //group by
			false, // navStartParams
			array('ID') //selectFields
		);
		$row->AddViewField('ELEM_COUNT', $list['ELEM_COUNT'].'/'.$totalCnt);
	}

	$arActions = Array(
		array(
			'TEXT'=> $row->arRes['ACTIVE'] == 'Y' ? GetMessage('vettich.autopostingplus_list_deactivate') : GetMessage('vettich.autopostingplus_list_activate'),
			'ACTION'=>$lAdmin->ActionDoGroup($list['ID'], $row->arRes['ACTIVE'] == 'Y' ? 'deactivate' : 'activate'),
		),
		array('SEPARATOR' => true),
		array(
			'ICON'=>'edit',
			'DEFAULT'=>true,
			'TEXT'=>GetMessage('vettich.autopostingplus_list_detail'),
			'ACTION'=>$lAdmin->ActionRedirect($edit_action_url.'?ID='.$list['ID']),
		),
		array(
			'ICON'=>'delete',
			'TEXT'=>GetMessage('vettich.autopostingplus_list_delete'),
			'ACTION'=>'if(confirm("'.GetMessage('vettich.autopostingplus_list_delete_confirm').'")) '.$lAdmin->ActionDoGroup($list['ID'], 'delete')
		),
	);
	$row->AddActions($arActions);
}

$lAdmin->AddGroupActionTable(Array(
	"delete"=>true,
));
$lAdmin->arActions['activate'] = GetMessage('vettich.autopostingplus_list_activate');
$lAdmin->arActions['deactivate'] = GetMessage('vettich.autopostingplus_list_deactivate');

$aContext = array(
	array(
		'TEXT'=>GetMessage('vettich.autopostingplus_category_add'),
		'LINK'=> $edit_action_url,
		'TITLE'=>GetMessage('vettich.autopostingplus_category_add'),
		'ICON'=>'btn_new',
	),
);
$lAdmin->AddAdminContextMenu($aContext);
$lAdmin->CheckListMode();

$pageTitle = GetMessage('vettich.autopostingplus_list_title');
$APPLICATION->SetTitle($pageTitle);

require_once ($DOCUMENT_ROOT.BX_ROOT.'/modules/main/include/prolog_admin_after.php');

$lAdmin->DisplayList();

\VOptions::showCSS();
/*?>
<div class="voptions-description" style="font-size:small">
<?=GetMessage('vettich.autopostingplus_list_description')?>
</div>
<?*/

require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/include/epilog_admin.php');
