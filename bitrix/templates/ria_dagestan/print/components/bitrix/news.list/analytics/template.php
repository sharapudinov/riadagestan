<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// global $arrFilter;
// $arrFilter['PROPERTY_MAIN'] = 1;

if($arParams["USE_RSS"]){
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arParams["TITLE_RSS"].'" href="'.SITE_DIR.'rss_mainnews.php" />');
}
if(count($arResult["ITEMS"]) > 0):
?>
<div class="analitika">
	<div class="zagolovok_fon"><h2 class="zagolovok_text">Аналитика</h2></div>	
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

	?>
	<div class="other-analitika">
		<p>
		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_IMG_MEDIUM"]["SRC"]?>" width="<?=$arItem["PREVIEW_IMG_MEDIUM"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_IMG_MEDIUM"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
		<?else:?>
			<img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_IMG_MEDIUM"]["SRC"]?>" width="<?=$arItem["PREVIEW_IMG_MEDIUM"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_IMG_MEDIUM"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
		<?endif;?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span><br>
		<?endif?>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><p class="line-height"><?echo $arItem["NAME"]?></p></a></p>
	</div>

<?endforeach;?>
</div>
<?endif;?>
