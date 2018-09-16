<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// global $arrFilter;
// $arrFilter['PROPERTY_MAIN'] = 1;

	
if($arParams["USE_RSS"]){
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arParams["TITLE_RSS"].'" href="'.SITE_DIR.'rss_mainnews.php" />');
}
if(count($arResult["ITEMS"]) > 0):
?>
<div class="lenta_novostey">
	<div class="zagolovok_fon"><h2 class="zagolovok_text">Лента новостей</h2></div>
	<ul class="b-mid-col__layout">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	if($arItem["PROPERTIES"]["MOLNIYA"]["VALUE"] == "1")
	{
		$molniya = "<span style='color:red'>молния</span>";
	}else
	{
		$molniya = "";
	}

	$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
	$mdata = mmdate($mdata,$mdata[15]);//моя функция она в файле f.php корневого каталога шаблона
	
	// $mdata = mb_ereg_replace("Ф","ф",$mdata); $mdata = mb_ereg_replace("Я","я",$mdata);  $mdata = mb_ereg_replace("А","а",$mdata);
	// $mdata = mb_ereg_replace("М","м",$mdata); $mdata = mb_ereg_replace("И","и",$mdata);  $mdata = mb_ereg_replace("С","с",$mdata);
	// $mdata = mb_ereg_replace("О","о",$mdata); $mdata = mb_ereg_replace("Н","н",$mdata);  $mdata = mb_ereg_replace("Д","д",$mdata);
	$ms = ($arItem["PROPERTIES"]["IMAGES"]["VALUE"] != null)?"<span class=\"b-mid-col__photo\"></span>":"";
	$ms2 = ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != null)?"<span class=\"b-mid-col__video\"></span>":"";
				?>
		<li>
			<div class="mid-layout__buttons">
			<?=$ms;?><?=$ms2;?>
			</div>
			<span><? echo $mdata;?></span> <?=$molniya?><br><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
		</li>

<?endforeach;?>
</ul>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

</div>
<?endif;?>
