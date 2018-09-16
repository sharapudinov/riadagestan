<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
/*test_dump($arResult["ITEMS"]);*/
IncludeTemplateLangFile(__FILE__);?>

<?
if(count($arResult["ITEMS"]) > 0):
?>
<div class="glav_novosti">
	<div class="zagolovok_fon"><h2 class="zagolovok_text"><?=GetMessage("MAIN_NEWS_TITLE")?></h2></div>
		<ul class="b-side-col__layout">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
		// $mdate = $arItem["DISPLAY_ACTIVE_FROM"]; //$arItem["DISPLAY_ACTIVE_FROM"];
		// $mdate = mmdate($mdate); //моя функция она в файле init.php
		$mass_date = get_date($arItem["DISPLAY_ACTIVE_FROM"]);
	?>
	<div class="glav-novosti-block">		
		<?if($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0] != null):?>
			<li class="b-side-col__anons-item">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<!--		<?/*
					if(SITE_ID == "s2"){*/?>
						<img class="preview_picture" border="0" src="<?/*=CFile::GetPath($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0]);*/?>" width="80" height="80" border="0" alt="<?/*=$arItem["NAME"]*/?>"/>
					--><?/*}elseif(SITE_ID == "s1"){*/
				$resize = "/upload/fotonews/resize1_" . $arItem["ID"] . ".jpg";

				 $resize_ob = $_SERVER["DOCUMENT_ROOT"].$resize;

						CFile::ResizeImageFile(
							$_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0]),
							$resize_ob,
							array('width'=>80, 'height'=>80),
							BX_RESIZE_IMAGE_EXACT,
							array()
					 	);

						?>
						<img class="preview_picture" border="0" src="<?=$resize;?>" width="80" height="80" border="0" alt="<?=$arItem["NAME"]?>"/>
<!--					--><?/*}*/?>
				</a>
				<span><?=$mass_date["day"]?> <?=$mass_date["month"]?> <?=$mass_date["year"]?> <?=$mass_date["time"]?></span>
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<p>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					<?else:?>
						<?echo $arItem["NAME"]?>
					<?endif;?>
					</p>
				<?endif;?>			
			</li>
		<?else:?>
			<li class="b-side-col__anons-item">								
					<span><?=$mass_date["day"]?> <?=$mass_date["month"]?> <?=$mass_date["year"]?> <?=$mass_date["time"]?></span>					
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<p>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					<?else:?>
						<?echo $arItem["NAME"]?>
					<?endif;?>
					</p>
				<?endif;?>			
			</li>
		<?endif?>


	</div>
<?endforeach;?>
		</ul>
</div>
<?endif;?>
