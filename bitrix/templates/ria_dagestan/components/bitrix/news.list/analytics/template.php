<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*test_dump();*/

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) > 0):
?>
<div class="analitika">
	<div class="zagolovok_fon"><h2 class="zagolovok_text"><?=$arResult['SECTION']['PATH'][count($arResult['SECTION']['PATH'])-1]['NAME']?></h2><div class="vse_temi"><a href="/news/analytics/"><?=GetMessage("all");?></a></div></div>
		
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

	//$mdate = $arItem["DISPLAY_ACTIVE_FROM"]; //$arItem["DISPLAY_ACTIVE_FROM"];
	//$mdate = mmdate($mdate);//моя функция она в файле init.php
	//if($mdate == "1") $mdate = $arItem["PROPERTIES"]["m_data"]["VALUE"];	

	$mass_date = get_date($arItem["DISPLAY_ACTIVE_FROM"]);
	?>
	<div class="other-analitika">
		<p>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_IMG_MEDIUM"]['SRC'];?>" width="<?=$arItem["PREVIEW_IMG_MEDIUM"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_IMG_MEDIUM"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
			<span><?=$mass_date["day"]?> <?=$mass_date["month"]?> <?=$mass_date["year"]?></span><br>
		
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><p class="line-height"><?echo $arItem["NAME"]?></p></a></p>
	</div>

<?endforeach;?>
</div>
<?endif;?>
