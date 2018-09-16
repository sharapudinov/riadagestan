<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$component->SetResultCacheKeys(array('SECTION'));
?>

<div class="lenta_novostey_news_spisok">

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

	$mass_date = get_date($arItem["DISPLAY_ACTIVE_FROM"]);
	
	$ms = ($arItem["PROPERTIES"]["IMAGES"]["VALUE"] != null)?"<span class=\"b-mid-col__photo\"></span>":"";
	$ms2 = ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != null)?"<span class=\"b-mid-col__video\"></span>":"";	
	
	?>
	<?$classPict = '';?>
	<li>
		<div class="mid-layout__buttons">
		<?=$ms;?><?=$ms2;?>
		</div>
		<span><?=$mass_date["day"]?> <?=$mass_date["month"]?> <?=$mass_date["year"]?> <?=$mass_date["time"]?></span><br><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
	</li>	
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</ul>					
</div>