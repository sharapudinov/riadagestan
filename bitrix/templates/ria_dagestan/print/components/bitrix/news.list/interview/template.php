<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// global $arrFilter;
// $arrFilter['PROPERTY_MAIN'] = 1;

if($arParams["USE_RSS"]){
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arParams["TITLE_RSS"].'" href="'.SITE_DIR.'rss_mainnews.php" />');
}
if(count($arResult["ITEMS"]) > 0):
?>
<div class="interviy">
	<div class="zagolovok_fon"><h2 class="zagolovok_text">Интервью</h2></div>
	<ul class="b-side-col__layout">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	?>
	<li class="b-side-col__anons-item"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_IMG_MEDIUM"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" width="80" height="80" border="0"></a>
	<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span><p><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></p>
	</li>
<?endforeach;?>
	</ul>
</div>
<?endif;?>
