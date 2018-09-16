<?
require __DIR__.'/admin_prefix.php';
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
IncludeModuleLangFile(__FILE__);

use Vettich\Autoposting\PostingFunc;

$module_id = 'vettich.autopostingplus';
$back_link = "vettich_autopostingplus_list.php";
$edit_link = "vettich_autopostingplus_detail.php";

if(isset($_GET['ID']) && ((int)$_GET['ID']) >= 0)
{
	$ID = (int)$_GET['ID'];
}
else
{
	LocalRedirect('vettich_autopostingplus_list.php');
	exit;
}

if(@$_POST['VOPTIONS_SUBMIT'] == 'Y')
{
	$arFields = array();
	$arSaveFields = array('ACTIVE', 'TYPE', 'STATUS');
	foreach($arSaveFields as $field)
	{
		if(!empty($_POST[$field]))
			$arFields[$field] = $_POST[$field];
	}
	if(!empty($arFields))
	{
		Vettich\AutopostingPlus\DBElementsTable::update($ID, $arFields);
		if(trim($_POST['Save']) != '')
			LocalRedirect($back_link);
		else
			LocalRedirect($edit_link.'?ID='.$ID);
	}
}

$aMenu = array(
	array(
		"TEXT"=>GetMessage('vettich.autopostingplus_detail_back'),
		"LINK"=>$back_link."?lang=".LANG,
		"ICON"=>"btn_list",
	),
	array("SEPARATOR"=>"Y"),
	array(
		"TEXT"=>GetMessage("vettich.autopostingplus_detail_delete"),
		"LINK"=>"javascript:if(confirm('".GetMessage("vettich.autopostingplus_detail_delete_confirm")."')) window.location='".$back_link."?ID=".$ID."&action=delete&lang=".LANG."&".bitrix_sessid_get()."';",
		"ICON"=>"btn_delete",
	),
);
$context = new CAdminContextMenu($aMenu);
$context->Show();

$arElem = Vettich\AutopostingPlus\DBElementsTable::GetRow(array(
	'order' => array('LAST_MODIFIED' => 'asc'),
	'filter' => array('ID' => $ID),
	'select' => array(
		'*',
		'PUB_' => 'PUBLICATION.*',
		'OPT_' => 'OPTION.*',
	),
));

$b = CIBlockElement::GetByID($arElem['ELEM_ID'])->Fetch();
if($b)
	$elem_name = '['.$arElem['ELEM_ID'].'] '.$b['NAME'];
$b = CIBlock::GetByID($arElem['IBLOCK_ID'])->Fetch();
$elem_ib_type = $b['IBLOCK_TYPE_ID'];
$iblock_name = '['.$arElem['IBLOCK_ID'].'] '.$b['NAME'];
if($arElem['STATUS'] == 'READY')
{
	if($arElem['OPT_PENDING_PUBLICATION_IS_INTERVAL'] == 'Y')
	{
		$arActivePubElems = Vettich\AutopostingPlus\DBElementsTable::GetRow(array(
			'select' => array('CNT'),
			'filter' => array(
				'<LAST_MODIFIED' => $arElem['LAST_MODIFIED'],
				'PUBLICATION_ID' => $arElem['PUBLICATION_ID'],
				'ACTIVE' => $arElem['ACTIVE'],
				'STATUS' => 'READY',
			),
			'runtime' => array(
				new Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)')
			)
		));
		$activePubElems = $arActivePubElems['CNT'];
		if(is_object($arElem['OPT_PENDING_PUBLICATION_NEXT_DATETIME']))
			$pubDate = new \DateTime($arElem['OPT_PENDING_PUBLICATION_NEXT_DATETIME']->toString());
		else
			$pubDate = new \DateTime('00-00-00 00.00.00');
		$m = ($activePubElems) * $arElem['OPT_PENDING_PUBLICATION_INTERVAL'];
		if($m > 0)
			$pubDate->add(new \DateInterval('PT'.$m.'M'));
		$pubDate = \Bitrix\Main\Type\DateTime::createFromPhp($pubDate)->toString();
		// $pubDate = date('d.m.Y h:i:s', $pubDate);
	}
	else
	{
		$pubDate = $arElem['PUBLICATION_DATE']->toString();
	}
}
if($pubDate && (new DateTime($pubDate)) < (new DateTime()))
	$pubDate = (new \Bitrix\Main\Type\DateTime())->toString();

$arPosts = array();
foreach(PostingFunc::__GetPosts() as $post)
{
	if(!PostingFunc::isModule($post))
		continue;
	$mpost = PostingFunc::module2($post);
	foreach($arElem['PUB_ACCOUNT_'.strtoupper($post)] as $acc_id)
	{
		$accValues = $mpost['func']::GetValues($acc_id);
		$post_id = $arElem['ACCOUNT_'.strtoupper($post)][$acc_id];
		$arPosts[$post][$acc_id]['name'] = $accValues['NAME'];
		if($post_id)
		{
			$url = $mpost['posting']::getUrlPost($accValues, $post_id);
			$arPosts[$post][$acc_id]['url'] = '<a href="'.$url.'" target="_blank">'.$url.'</a>';
		}
		else
			$arPosts[$post][$acc_id]['url'] = GetMessage('vettich.autopostingplus_detail_post_id_empty');
	}
}

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
			'NAME' => GetMessage('vettich.autopostingplus_detail_tab1'),
			'TITLE' => GetMessage('vettich.autopostingplus_detail_tab1_title'),
		)
	),
	'PARAMS' => array(
		'ID' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => 'ID',
			'HTML' => '<b>'.$ID.'</b>',
		),
		'ACTIVE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CHECKBOX',
			'NAME' => GetMessage('vettich.autopostingplus_detail_ACTIVE'),
			'VALUE' => $arElem['ACTIVE'],
		),
		'ELEM' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_detail_ELEM'),
			'HTML' => ($elem_name ? 
				'<a href="iblock_element_edit.php?IBLOCK_ID='.$arElem['IBLOCK_ID'].'&ID='.$arElem['ELEM_ID'].'&type='.$elem_ib_type.'">'.$elem_name.'</a>'
				: GetMessage('vettich.autopostingplus_detail_ELEM_NOT_FOUND', array('#ID#'=>$arElem['ELEM_ID']))),
		),
		'IBLOCK' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_detail_IBLOCK'),
			'HTML' => '<a href="iblock_edit.php?ID='.$arElem['IBLOCK_ID'].'&type='.$elem_ib_type.'">'.$iblock_name.'</a>',
		),
		'TYPE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_detail_TYPE'),
			'VALUE' => $arElem['TYPE'],
			'VALUES' => array(
				'ADD' => GetMessage('vettich.autopostingplus_detail_TYPE_ADD'),
				'EDIT' => GetMessage('vettich.autopostingplus_detail_TYPE_EDIT'),
				'DELETE' => GetMessage('vettich.autopostingplus_detail_TYPE_DELETE'),
			),
			'HELP' => GetMessage('vettich.autopostingplus_detail_TYPE_HELP'),
		),
		'STATUS' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'LIST',
			'NAME' => GetMessage('vettich.autopostingplus_detail_STATUS'),
			'VALUE' => $arElem['STATUS'],
			'VALUES' => array(
				'READY' => GetMessage('vettich.autopostingplus_detail_STATUS_READY'),
				// 'WAIT' => 'WAIT',
				'OK' => GetMessage('vettich.autopostingplus_detail_STATUS_OK'),
			),
			'HELP' => GetMessage('vettich.autopostingplus_detail_STATUS_HELP'),
		),
		'PUBLICATION_ID' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_detail_PUBLICATION_ID'),
			'HTML' => '<a href="vettich_autoposting_posts_edit.php?ID='.$arElem['PUBLICATION_ID'].'">'.$arElem['PUB_NAME'].'</a>',
		),
		'PUBLICATION_DATE' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_detail_PUBLICATION_DATE'),
			'HTML' => $pubDate ?: GetMessage('autopostingplus_detail_PUBLICATION_DATE_OK'),
			'HELP' => GetMessage('vettich.autopostingplus_detail_PUBLICATION_DATE_HELP'),
		),
		'LAST_MODIFIED' => array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => GetMessage('vettich.autopostingplus_detail_LAST_MODIFIED'),
			'HTML' => ($arElem['LAST_MODIFIED'] ? $arElem['LAST_MODIFIED']->toString() : ''),
		),
	),
);

if(!empty($arPosts))
{
	$arModuleParams['PARAMS']['ACCOUNTS_TITLE'] = array(
		'TAB' => 'TAB1',
		'TYPE' => 'NOTE',
		'TEXT' => GetMessage('vettich.autopostingplus_detail_ACCOUNTS_TITLE'),
	);
	foreach($arPosts as $post => $arPost)
	{
		$mpost = PostingFunc::module2($post);
		$html = '';
		foreach($arPost as $k => $v)
		{
			$html .= '<b>'.$v['name'].':</b> '.$v['url'];
		}
		$arModuleParams['PARAMS']['ACCOUNT_'.$post] = array(
			'TAB' => 'TAB1',
			'TYPE' => 'CUSTOM',
			'NAME' => $mpost['func']::get_name(),
			'HTML' => $html,
		);
	}
}

$pageTitle = GetMessage('vettich.autopostingplus_detail_title');
$APPLICATION->SetTitle($pageTitle);

$vopt = new VOptions();

$vopt->init_module_params();
$vopt->show();

?>
<div class="voptions-description" style="font-size:small">
	<?=GetMessage('vettich.autopostingplus_detail_description');?>
</div>
<?
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
