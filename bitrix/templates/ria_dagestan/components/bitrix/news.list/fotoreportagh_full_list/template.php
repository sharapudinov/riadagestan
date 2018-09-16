<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
?>
	<div class="fotorep_vnt">

		<div class="zagolovok_fon"> 
			<h2 class="zagolovok_text"><?=GetMessage("title");?></h2>
		</div>
<?$showHr = false;?>
<?$showHr = false; $q = RandString(5);?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID']."_".$q, $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID']."_".$q, $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	
	if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):
		$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
		$mdata = mmdate($mdata,$mdata[15]);//моя функция она в файле f.php корневого каталога шаблона
	endif;
	?>
	<div class="fotorep_block">
		<div class="fotorep_block_head">
			<span class="itemDateCreated"><?=$mdata;?></span>
			<p class="nadp_sverhu"><?=$arItem["NAME"]?></p>
		</div>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
	</div>
<?endforeach;?>
<div style="clear:both;"></div>	
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
