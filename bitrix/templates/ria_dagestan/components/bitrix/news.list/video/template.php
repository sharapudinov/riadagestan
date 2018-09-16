<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
IncludeTemplateLangFile(__FILE__);
if(count($arResult["ITEMS"]) > 0):
?>
<script>
 $(document).ready(function(){
	$('.ria_video iframe').attr({"width":"273","height":"195"})
	


 });
</script>
<div class="ria_video">
	<div class="zagolovok_fon"><h2 class="zagolovok_text"><?=GetMessage("vhead");?></h2><div class="vse_temi"><a href="/video/"><?=GetMessage("all");?></a></div></div>
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
		<? 
			/*$video_view1 = str_replace("ifr ame", "iframe", $arItem["PROPERTIES"]["video_iframe"]["VALUE"]);
			$video_view1 = str_replace("</ifr>", "</iframe>", $video_view1);
			$video_view1 = str_replace("//", "http://", $video_view1);*/
		?>
		<?=htmlspecialchars_decode($arItem["PROPERTIES"]["video_iframe"]["VALUE"])?>
<?endforeach;?>
</div>
<?endif;?>
