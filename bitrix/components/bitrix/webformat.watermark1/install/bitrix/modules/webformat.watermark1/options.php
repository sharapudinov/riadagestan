<?php
//Including lang-file
IncludeModuleLangFile( __FILE__ );

//Including module (executing "include.php" code)
CModule::IncludeModule('webformat.watermark1');
$webformatLangPrefix = $webformatLangPrefix = 'WEBFORMAT_WATERMARK1_';

if((int)substr(SM_VERSION, 0, 2) < 11){ShowError(GetMessage($webformatLangPrefix.'NOT_SUPPORTED'));}

if(isset($_REQUEST['webformat_bsend'])){WebformatWatermark1Utils::SaveOptions($_POST);}


//Tabs description
$aTabs = array();
$aTabs[] = array(
	'DIV'   => 'webformat_watermark1_iblocks',
	'TAB'   => GetMessage($webformatLangPrefix.'TAB_IBLOCKS'),
	'ICON'  => '',
	'TITLE' => ''
);
$aTabs[] = array(
	'DIV'   => 'webformat_watermark1_watermark',
	'TAB'   => GetMessage($webformatLangPrefix.'TAB_WATERMARK'),
	'ICON'  => '',
	'TITLE' => ''
);

//Including CSS
	ob_start();
		include('css/style.css');
		$css .= ob_get_contents();
	ob_end_clean();
	$APPLICATION->AddHeadString('<style>'.$css.'</style>');
//---End---Including CSS

//Including JavaScript
	ob_start();
		include('js/scripts.js');
		$scripts .= ob_get_contents();
	ob_end_clean();

	ob_start();
		include('js/bxfiledialog-check.js');
		$scripts = str_replace('//#AUTO_INSERTION_PLACE', $scripts, ob_get_contents());
	ob_end_clean();

	ob_start();
		include('js/jquery-check.js');
		$scripts = str_replace('//#AUTO_INSERTION_PLACE', $scripts, ob_get_contents());
	ob_end_clean();
	$APPLICATION->AddHeadString('<script>'.$scripts.'</script>');
//---End---Including JavaScript

//Initialazing tabs
$oTabControl = new CAdmintabControl('tabControl', $aTabs);
$oTabControl->Begin();
?>
<form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=webformat.watermark1&lang=<?=LANG?>&mid_menu=1">
	<?=bitrix_sessid_post()?>

	<?php
		$options = WebformatWatermark1Utils::GetOptions();
		
		foreach($aTabs as $tab){
			$oTabControl->BeginNextTab();
			switch($tab['DIV']){
				case 'webformat_watermark1_iblocks':
					include('options_tabs/iblocks.php');
					break;
				case 'webformat_watermark1_watermark':
					include('options_tabs/watermark.php');
					break;
			}

			?>
			<tr><td colspan="2"><br></td></tr>
		<?}?>

	<?$oTabControl->Buttons();?>
	<input type="submit" name="webformat_bsend" value="<?=GetMessage($webformatLangPrefix.'BSEND')?>" />
	<?$oTabControl->End();?>
</form>