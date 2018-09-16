<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// global $arrFilter;
// $arrFilter['PROPERTY_MAIN'] = 1;

	function mmdate($mdate,$ch=1)
	{
		//$ch = $mdata[15];
		$time = substr($mdate,strlen($mdata)-5,strlen($mdata)-1)."".$ch;
		$date = explode(".",substr($mdate,0,10));
		switch($date[1])
		{
			case "02":$month = "февраль"; break;
			case "03":$month = "март"; break;
			case "04":$month = "апрель"; break;
			default: $month = "qwe";
		}
		return $date[0] . " ". $month . " " . $time;
	}
	
if($arParams["USE_RSS"]){
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arParams["TITLE_RSS"].'" href="'.SITE_DIR.'rss_mainnews.php" />');
}
if(count($arResult["ITEMS"]) > 0):
?>
<div class="lenta-novostey">
				<h3>Лента новостей</h3>
				<div class="line"></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	if($arItem["PROPERTIES"]["MOLNIYA"]["VALUE"] == "1")
	{
		$molniya = "молния";
	}else
	{
		$molniya = "";
	}

	$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
	$mdata = mmdate($mdata,$mdata[15]);
	
	// $mdata = mb_ereg_replace("Ф","ф",$mdata); $mdata = mb_ereg_replace("Я","я",$mdata);  $mdata = mb_ereg_replace("А","а",$mdata);
	// $mdata = mb_ereg_replace("М","м",$mdata); $mdata = mb_ereg_replace("И","и",$mdata);  $mdata = mb_ereg_replace("С","с",$mdata);
	// $mdata = mb_ereg_replace("О","о",$mdata); $mdata = mb_ereg_replace("Н","н",$mdata);  $mdata = mb_ereg_replace("Д","д",$mdata);

	
	?>	
	<div class="novost"><?=strlen($mdata)?>
		<div class="novost-text">
		<?if($arParams["DISPLAY_DATE"]!="N" || $arItem["DISPLAY_ACTIVE_FROM"]):?>	
			<span><? echo $mdata;?><span class="molnia"><?=$molniya?></span></span><br/>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><p class="line-height"><?=$arItem["NAME"]?></p></a>
			<?else:?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><p class="line-height"><?=$arItem["NAME"]?></p></a>
			<?endif;?>
		<?endif;?>	
		</div>
		<div class="novost-metki">
			<img class="fotik" src="<?=SITE_TEMPLATE_PATH?>/img/fotokamera.png">
			<img class="kamera" src="<?=SITE_TEMPLATE_PATH?>/img/kamera.png">
		</div>
	</div>
<?endforeach;?>
</div>
<?endif;?>
