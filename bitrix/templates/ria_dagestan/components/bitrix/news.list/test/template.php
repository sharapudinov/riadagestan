<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?if(count($arResult["ITEMS"]) > 0):?>
<a name="lenta"></a>
<div class="lenta_novostey">
	<div class="zagolovok_fon"><h2 class="zagolovok_text">Лента новостей
	<?
	if(isset($_POST['mmmdata'])){
		echo "за ".$_POST['mmmdata'];
	}?>
	</h2></div>
	<ul class="b-mid-col__layout">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	//ACTIVE_FROM
	//DATE_ACTIVE_FROM
	//DISPLAY_ACTIVE_FROM
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	

	if($arItem["PROPERTIES"]["MOLNIYA"]["VALUE"] == "1")
	{
		$molniya = "<span style='color:red; font-weight:bold;'>молния</span>";
	}else
	{
		$molniya = "";
	}

	$mdate = $arItem["DISPLAY_ACTIVE_FROM"]; //$arItem["DISPLAY_ACTIVE_FROM"];
	$mdate = mmdate($mdate);//моя функция она в файле init.php
	if($mdate == "1") $mdate = $arItem["PROPERTIES"]["m_data"]["VALUE"];
	
	$ms = ($arItem["PROPERTIES"]["IMAGES"]["VALUE"] != null)?"<span class=\"b-mid-col__photo\"></span>":"";
	$ms2 = ($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != null)?"<span class=\"b-mid-col__video\"></span>":"";
				?>
		<li><?//PR($arItem)?>
			<div class="mid-layout__buttons">
			<?=$ms;?><?=$ms2;?>
			</div>
			<span><?=$mdate?> <span style="">@<?=$arItem["DISPLAY_ACTIVE_FROM"];?>@</span></span> <?=$molniya?><br><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
		</li>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</ul>
</div>
<?endif;?>

