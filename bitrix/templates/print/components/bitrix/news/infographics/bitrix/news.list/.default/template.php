<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="container_infblock">
	<h1>Инфографика</h1>
	
	
	
	<div class="tab_container">
	
		<div style="display: block;" id="tab1" class="tab_content">
			
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br/>
<?endif;?>
<?$showHr = false;?>
<?$showHr = false; $q = RandString(5);?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID']."_".$q, $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID']."_".$q, $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
	
	if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"])
	{
		$mdata = $arItem["DISPLAY_ACTIVE_FROM"];
		$mdata = mmdate($mdata,$mdata[15]);//моя функция она в файле f.php корневого каталога шаблона
	}else{ $mdata = ""; }
	?>
					<div class="infblock_wrapper">	
					
						<div class="infblock">
							<a class="fancybox" href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" data-fancybox-group="gallery"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"/></a></a>
							<div class="infblock_text">
								<span class="infblock_zagolovok"><?=$arItem["NAME"]?></span>
								<p><?echo $arItem["PREVIEW_TEXT"];?></p>
							</div>
							
							<!--<div class="infblock_niz">					
								<span class="tags_icons"><a href="" title="Тег: Инфографика"><img src="<?=SITE_TEMPLATE_PATH?>/img/334.png" alt=""> </a></span>
								<div class="fright">
									<span class="count-vievers">262</span>												
								</div>
							</div>-->
						</div>  
					</div>

<?endforeach;?>
	</div>
</div>
<div style="clear:both;"></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<br/>
<script type="text/javascript" src="//yandex.st/share/share.js"
charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,gplus"

></div> 
</div>
	
