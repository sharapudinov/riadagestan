<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
<div class="news-detail">
	<img class="detail_picture" border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="220<?//=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<div class="desc_th">
		<div class="zagolovok_fon">
			<h2 class="zagolovok_text"><?=$arResult["NAME"]?></h2>
		</div>
		<span><?=$arResult["PREVIEW_TEXT"]?></span>
	</div>
</div>
<?endif;?>