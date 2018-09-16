<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="lenta_novostey_news_spisok" >

	<div class="zagolovok_fon"><h2 class="zagolovok_text"><?echo $arResult["SECTION"]["PATH"][0]["NAME"]?></h2></div>
	<ul class="b-mid-col__layout">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$showHr = false;?>
<?$showHr = false; $q = RandString(5);?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID']."_".$q, $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID']."_".$q, $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	
	$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
	$mdata = mmdate($mdata,$mdata[15]);//моя функция
	
	$ms = ($arItem["PROPERTIES"]["IMAGES"]["VALUE"] != null)?"<span class=\"b-mid-col__photo\"></span>":"";
	$ms2 = ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != null)?"<span class=\"b-mid-col__video\"></span>":"";	
	
	?>
	<?$classPict = '';?>
	<li>
		<div class="mid-layout__buttons">
		<?=$ms;?><?=$ms2;?>
		</div>
		<span><? echo $mdata;?></span><br><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
	</li>	
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</ul>					
</div>