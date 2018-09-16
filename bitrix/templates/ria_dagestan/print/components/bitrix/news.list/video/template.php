<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arParams["USE_RSS"]){
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arParams["TITLE_RSS"].'" href="'.SITE_DIR.'rss_mainnews.php" />');
}
if(count($arResult["ITEMS"]) > 0):
?>
<script>
 $(document).ready(function(){
	$('.ria_video iframe').attr({"width":"285","height":"195"})
 });
</script>
<div class="ria_video">
	<div class="zagolovok_fon"><h2 class="zagolovok_text">РИА видео</h2></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	?>	
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			 <p>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<?=$arItem["NAME"]?>
			<?else:?>
				<?echo $arItem["NAME"]?>
			<?endif;?>
			</p>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?=$arItem["PREVIEW_TEXT"];?>
		<?endif;?>
<?endforeach;?>
<br />
<a class="vse" href="/video/">все видео</a> 
</div>
<?endif;?>
