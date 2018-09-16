<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<script>
$(document).ready(function(){
	$('.video_block iframe').attr({"width":"294","height":"210"});
});
</script>
<div class="video_vnt">

	<div class="other_video_block">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br/>
<?endif;?>
<?$showHr = false;?>
<?$showHr = false; $q = RandString(5);?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID']."_".$q, $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID']."_".$q, $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	
	if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"])
	{
		$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
		$mdata = mmdate($mdata,$mdata[15]);//моя функция она в файле f.php корневого каталога шаблона
	}else{ $mdata = ""; }
	?>

	<div class="video_block">
		<? 
			$video_view = str_replace("ifr ame", "iframe", $arItem["PROPERTIES"]["video_iframe"]["VALUE"]);
			//$video_view = str_replace("</ifr>", "</iframe>", $video_view);
		?>
		<?=htmlspecialchars_decode($video_view)?>
		<br/>
		<p class="podpis_video"><a href=""><?=$arItem["NAME"]?></a></p>
		<div class="date"><?=$mdata;?></div>
	</div>

<?endforeach;?>
	</div>
</div>
				<div style="clear:both;"></div>	
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>