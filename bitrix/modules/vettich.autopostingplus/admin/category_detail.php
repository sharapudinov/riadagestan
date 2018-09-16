<?
require __DIR__.'/admin_prefix.php';
require_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');
IncludeModuleLangFile(__FILE__);

use Vettich\Autoposting\PostingFunc;
use Vettich\Autoposting\PostingOption;
use Vettich\AutopostingPlus\Func;

$module_id = 'vettich.autopostingplus';
$back_link = 'vettich_autopostingplus_category_list.php';
$detail_link = 'vettich_autopostingplus_category_detail.php';

$ID = 0;
if(intval($_GET['ID']) > 0)
	$ID = $_GET['ID'];

$arFields = Func::GetValues($ID, Func::DB_CATEGORY_TABLE);
if(empty($arFields))
{
	$arFields = array(
		'NAME' => 'Category ['.PostingFunc::GetNextIdDB(Func::DB_CATEGORY_TABLE).']',
		'ACTIVE' => 'Y',
		'ADD_TO_QUEUE' => 'Y',
	);
}
if(empty($arFields['SORT']))
{
	unset($_POST['SORT']);
	$arFields['SORT'] = 'ID';
}

if(@$_POST['VOPTIONS_SUBMIT'] == 'Y')
{
	if(!empty($arFields))
	{
		$db = Func::DB_CATEGORY_TABLE;
		if($ID > 0)
			$db::update($ID, $arFields);
		else
		{
			$rs = $db::add($arFields);
			if($rs->isSuccess())
				$ID = $rs->getId();
		}
	}
	if(trim($_POST['Save']) != '')
		LocalRedirect($back_link);
	else
		LocalRedirect($detail_link.'?ID='.$ID);
	exit;
}

$arPosts = array();
$db = PostingFunc::DBTABLE;
$ar = $db::getList(array(
	'select' => array('ID', 'NAME'),
	'filter' => array('TYPE' => PostingFunc::DBTYPEPOSTS)
))->FetchAll();
foreach($ar as $a)
	$arPosts[$a['ID']] = $a['NAME'];

$arIblockType = PostingOption::getIBlockTypes();
$arIblock = PostingOption::getIBlocks($arFields['IBLOCK_TYPE'], $arFields['IBLOCK_ID']);
$arIblock = $arIblock[$arFields['IBLOCK_TYPE']] ?: $arIblock['none'];
$arProp = PostingOption::getProps($arFields['IBLOCK_ID']);
$arProp = $arProp[$arFields['IBLOCK_ID']] ?: $arProp['none'];

if(intval($arFields['IBLOCK_ID']))
{
	$arFilter = array('IBLOCK_ID' => $arFields['IBLOCK_ID'], 'ACTIVE' => 'Y'); 
	$arSelect = array('ID', 'NAME', 'DEPTH_LEVEL');
	$rsSection = CIBlockSection::GetTreeList($arFilter, $arSelect);
	$arSections = array('' => GetMessage('vettich.autopostingplus_category_section_select'));
	while($ar = $rsSection->Fetch())
		$arSections[$ar['ID']] = str_repeat('- ', $ar['DEPTH_LEVEL']).$ar['NAME'];
}
if(!$arSections)
	$arSections = array('' => GetMessage('vettich.autopostingplus_category_section_empty'));

$aMenu = array(
	array(
		'TEXT'=>GetMessage('vettich.autopostingplus_category_back_to_list'),
		'LINK'=>$back_link.'?lang='.LANG,
		'ICON'=>'btn_list',
	),
);
if($ID > 0)
{
	$aMenu[] = array("SEPARATOR"=>"Y");
	$aMenu[] = array(
		"TEXT"=>GetMessage("VCH_POSTS_EDIT_ADD"),
		"TITLE"=>GetMessage("VCH_POSTS_EDIT_ADD_TITLE"),
		"LINK"=>$edit_link."?lang=".LANG,
		"ICON"=>"btn_new",
	);
	$aMenu[] = array(
		"TEXT"=>GetMessage("VCH_POSTS_EDIT_DEL"),
		"TITLE"=>GetMessage("VCH_POSTS_EDIT_DEL_TITLE"),
		"LINK"=>"javascript:if(confirm('".GetMessage("VCH_POSTS_EDIT_DEL_CONF")."')) window.location='".$back_link."?ID=".$ID."&action=delete&lang=".LANG."&".bitrix_sessid_get()."';",
		"ICON"=>"btn_delete",
	);
}
$context = new CAdminContextMenu($aMenu);
$context->Show();

$arModuleParams = array(
	'FORM' => array(
		'PARAMS' => array(
			'ID' => $ID,
		),
		'TYPE' => array('WITH_PARAMS', 'NOT_DEFAULT'),
	),
	'BUTTONS' => array(
		'SAVE' => array(
			'NAME' => GetMessage('SAVE_BUTTON'),
		),
		'APPLY' => array(
			'NAME' => GetMessage('APPLY_BUTTON'),
		),
		'RESTORE_DEFAULTS' => array(
			'ENABLE' => 'N',
		)
	),
	'TABS' => array(
		'TAB1' => array(
			'NAME' => GetMessage('vettich.autopostingplus_category_tab1'),
			'TITLE' => ($ID > 0 ? GetMessage('vettich.autopostingplus_category_title') : GetMessage('vettich.autopostingplus_category_title_add')),
		)
	),
	'PARAMS' => array(
		'NAME' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'STRING',
			'NAME' => GetMessage('vettich.autopostingplus_category_NAME'),
			'VALUE' => $arFields['NAME'],
			'SORT' => 100,
		),
		'ACTIVE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CHECKBOX',
			'NAME' => GetMessage('vettich.autopostingplus_category_ACTIVE'),
			'VALUE' => $arFields['ACTIVE'],
			'SORT' => 200,
		),
		'PUBLICATION_ID' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_category_PUBLICATION_ID'),
			'VALUES' => $arPosts,
			'VALUE' => $arFields['PUBLICATION_ID'],
			'SORT' => 300,
		),
		'IBLOCK_TYPE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_category_IBLOCK_TYPE'),
			'VALUES' => $arIblockType,
			'VALUE' => $arFields['IBLOCK_TYPE'],
			'REFRESH' => 'Y',
			'SORT' => 400,
		),
		'IBLOCK_ID' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_category_IBLOCK_ID'),
			'VALUES' => $arIblock,
			'VALUE' => $arFields['IBLOCK_ID'],
			'REFRESH' => 'Y',
			'SORT' => 500,
		),
		'SUBCATEGORIES' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'NAME' => GetMessage('vettich.autopostingplus_category_SUBCATEGORIES'),
			'HELP' => GetMessage('vettich.autopostingplus_category_SUBCATEGORIES_HELP'),
			'VALUES' => $arSections,
			'VALUE' => $arFields['SUBCATEGORIES'],
			'SORT' => 600,
		),
		'TYPE0' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_category_TYPE0'),
			'SORT' => 700,
		),
		'TYPE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_category_TYPE'),
			'HELP' => GetMessage('vettich.autopostingplus_category_TYPE_HELP'),
			'HELP' => GetMessage('vettich.autopostingplus_category_TYPE_HELP'),
			'VALUES' => array(
				'SIMPLE' => GetMessage('vettich.autopostingplus_category_TYPE_ALTERNATELY'),
				'RAND' => GetMessage('vettich.autopostingplus_category_TYPE_RAND'),
			),
			'VALUE' => $arFields['TYPE'],
			'SORT' => 720,
		),
		'TYPE2' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_category_TYPE2'),
			'HELP' => GetMessage('vettich.autopostingplus_category_TYPE2_HELP'),
			'VALUES' => array(
				'SIMPLE' => GetMessage('vettich.autopostingplus_category_TYPE_GRADUALY'),
				'RAND' => GetMessage('vettich.autopostingplus_category_TYPE_RAND'),
			),
			'VALUE' => $arFields['TYPE2'],
			'SORT' => 760,
			'REFRESH' => 'Y',
		),
		'ADD_TO_QUEUE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CHECKBOX',
			'NAME' => GetMessage('vettich.autopostingplus_category_ADD_TO_QUEUE'),
			'HELP' => GetMessage('vettich.autopostingplus_category_ADD_TO_QUEUE_HELP'),
			'VALUE' => $arFields['ADD_TO_QUEUE'],
			'SORT' => 900,
		),
	),
);

if($arFields['TYPE2'] == 'SIMPLE')
{
	$arModuleParams['PARAMS']['SORT'] = array(
		'TAB' => 'TAB1',
		'TYPE' => 'LIST',
		'NAME' => GetMessage('vettich.autopostingplus_category_SORT'),
		'HELP' => GetMessage('vettich.autopostingplus_category_SORT_HELP'),
		'VALUES' => $arProp,
		'VALUE' => $arFields['SORT'],
		'SORT' => 800,
		'DISPLAY' => 'inline',
	);
	$arModuleParams['PARAMS']['SORT_ORDER'] = array(
		'TAB' => 'TAB1',
		'TYPE' => 'LIST',
		'VALUES' => array(
			'asc' => GetMessage('vettich.autopostingplus_category_SORT_asc'),
			'desc' => GetMessage('vettich.autopostingplus_category_SORT_desc')
		),
		'VALUE' => $arFields['SORT_ORDER'],
		'SORT' => 810,
		'DISPLAY' => 'inline',
	);
}

if($ID > 0)
{
	if(!empty($arFields['IBLOCK_ID']))
	{
		$arFilter = array(
			'IBLOCK_ID' => $arFields['IBLOCK_ID'],
		);
		if(!empty($arFields['SUBCATEGORIES']))
		{
			$arFilter['SECTION_ID'] = $arFields['SUBCATEGORIES'];
			$arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
		}
		$totalCnt = CIBlockElement::GetList(
			array(), //sort
			$arFilter,
			array(), //group by
			false, // navStartParams
			array('ID') //selectFields
		);
	}

	$arModuleParams['PARAMS']['ELEM_COUNT'] = array(
		'TAB' => 'TAB1',
		'TYPE' => 'CUSTOM',
		'NAME' => GetMessage('vettich.autopostingplus_category_ELEM_COUNT'),
		'HTML' => intval($arFields['ELEM_COUNT']).'/'.intval($totalCnt),
		'SORT' => 110,
	);
	if(!empty($arFields['PREV_ELEM']))
	{
		$ar = CIBlockElement::GetByID($arFields['PREV_ELEM'])->Fetch();
		$arModuleParams['PARAMS']['PREV_ELEM'] = array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_category_PREV_ELEM'),
			'HTML' => "<a href=\"iblock_element_edit.php?IBLOCK_ID=$ar[IBLOCK_ID]&ID=$ar[ID]&type=$arFields[IBLOCK_TYPE]\">[$ar[ID]] $ar[NAME]</a>",
			'SORT' => 120,
		);
	}
	$arModuleParams['PARAMS']['LAST_MODIFIED'] = array(
		'TAB' => 'TAB1',
		'TYPE' => 'CUSTOM',
		'NAME' => GetMessage('vettich.autopostingplus_category_LAST_MODIFIED'),
		'HTML' => $arFields['LAST_MODIFIED'],
		'SORT' => 130,
	);
}

$pageTitle = GetMessage('vettich.autopostingplus_category_title_add');
if($ID > 0)
	$pageTitle = GetMessage('vettich.autopostingplus_category_title');
$APPLICATION->SetTitle($pageTitle);

$vopt = new VOptions();

$vopt->init_module_params();
$vopt->show();

if($_REQUEST['voptions_ajax'] == 'Y')
	exit;
?>
<div class="voptions-description" style="font-size:small">
	<?=GetMessage('vettich.autopostingplus_category_description');?>
</div>
<?
require_once($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/main/include/epilog_admin.php');
