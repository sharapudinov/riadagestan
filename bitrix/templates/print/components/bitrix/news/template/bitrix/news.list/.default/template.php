<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="lenta_novostey_news_spisok">
<?
	$_SERVER['REQUEST_URI'] = trim($_SERVER['REQUEST_URI'],"/");
	$murl = explode("/",$_SERVER['REQUEST_URI']);
	if($murl[0] == "news"){
?>
		<div class="zagolovok_fon">
		<h2 class="zagolovok_text">
		<?
			if($arResult["SECTION"]["PATH"][1]["NAME"] == null):
				echo $arResult["SECTION"]["PATH"][0]["NAME"];
			else:
				echo $arResult["SECTION"]["PATH"][1]["NAME"];
			endif;
		?>
		</h2></div>	
<?
	}elseif($murl[0] == "interview"){
?>
		<div class="zagolovok_fon"><h2 class="zagolovok_text">ИНТЕРВЬЮ</h2></div>			
<?
	}elseif($murl[0] == "analytics")
	{?>
		<div class="zagolovok_fon"><h2 class="zagolovok_text">АНАЛИТИКА</h2></div>
	<?}?>
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
	
	$mdate = $arItem["DISPLAY_ACTIVE_FROM"]; //$arItem["DISPLAY_ACTIVE_FROM"];
	$mdate = mmdate($mdate);//моя функция она в файле init.php
	if($mdate == "1") $mdate = $arItem["PROPERTIES"]["m_data"]["VALUE"];
	
	$ms = ($arItem["PROPERTIES"]["IMAGES"]["VALUE"] != null)?"<span class=\"b-mid-col__photo\"></span>":"";
	$ms2 = ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != null)?"<span class=\"b-mid-col__video\"></span>":"";	
	
	?>
	<?$classPict = '';?>
	<li>
		<div class="mid-layout__buttons">
		<?=$ms;?><?=$ms2;?>
		</div>
		<span><? echo $mdate;?></span><br><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
	</li>	
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</ul>					
</div>