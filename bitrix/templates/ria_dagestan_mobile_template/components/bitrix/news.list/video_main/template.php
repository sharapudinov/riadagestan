<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<script>
$(document).ready(function(){
	$('.main_video_block iframe').attr({"width":"620","height":"415"});
});
</script>
<?if(count($arResult["ITEMS"]) > 0):?>
<div class="main_video_block">
<?foreach($arResult["ITEMS"] as $arItem):?>

	<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time">
		<?
			$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
			$mdata = mmdate($mdata);
		?>
		<?echo $mdata;?>
		
		</span> <br>
	<?endif?>
	<? 
		$video_view = str_replace("ifr ame", "iframe", $arItem["PROPERTIES"]["video_iframe"]["VALUE"]);
		//$video_view = str_replace("</ifr>", "</iframe>", $video_view);
	?>
	<?=htmlspecialchars_decode($video_view)?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
		<p>
		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a><br />
		<?endif;?>
		</p>
	<?endif;?>
	
<?endforeach;?>
</div>
<?endif;?>
