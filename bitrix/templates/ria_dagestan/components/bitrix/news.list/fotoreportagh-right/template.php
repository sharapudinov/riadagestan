<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
// global $arrFilter;
// $arrFilter['PROPERTY_MAIN'] = 1;

if($arParams["USE_RSS"]){
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arParams["TITLE_RSS"].'" href="'.SITE_DIR.'rss_mainnews.php" />');
}
if(count($arResult["ITEMS"]) > 0):
?>
<div class="foto-reportazh">
	<div class="zagolovok_fon"><h2 class="zagolovok_text"><?=GetMessage("fhead");?></h2><div class="vse_temi"><a href="/fotoreportagh/"><?=GetMessage("all");?></a></div></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	?>

	
	<div class="foto-rep">

			<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
				<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span><br>
			<?endif?>
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<p class="line-height"><?=$arItem["NAME"]?></p>
				<?else:?>
					<b><?echo $arItem["NAME"]?></b><br />
				<?endif;?>
			<?endif;?>
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_IMG_MEDIUM"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_IMG_MEDIUM"]["SRC"]?>" width="<?=$arItem["PREVIEW_IMG_MEDIUM"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_IMG_MEDIUM"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<?else:?>
				<img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_IMG_MEDIUM"]["SRC"]?>" width="<?=$arItem["PREVIEW_IMG_MEDIUM"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_IMG_MEDIUM"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
			<?endif;?>
		<?endif?>

	</a>
	</div>
<?endforeach;?>
</div>
<?endif;?>
