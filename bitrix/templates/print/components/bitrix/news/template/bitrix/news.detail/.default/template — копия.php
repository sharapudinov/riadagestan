<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news_item1">
		<script>
			$(document).ready(function(){
				$('.mvideo iframe').attr({"width":"340","height":"255"});
			});
		</script>
			<div class="itemHeader">
			<!-- Item title -->
					<h1 class="itemTitle">
							<?=$arResult["NAME"]?>
					</h1>			
				<!-- Date created -->
					<span class="itemDateCreated">
						<?//=$arResult["DISPLAY_ACTIVE_FROM"]?>	
						<?=mmdate($arResult["PROPERTIES"]["m_data"]["VALUE"])?>
					</span>
				<!-- Item category -->
					<span class="itemCategory">
						<span>Опубликовано в&nbsp;</span><a href="<? echo($arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"])?>"><?echo $arResult["SECTION"]["PATH"][0]["NAME"]?></a>
					</span>
					<?
					if($arResult["PROPERTIES"]["LINK_SOURCE"]["VALUE"] != "")
					{
					?>
					<span class="itemCategory">
						<span>Источник: &nbsp;</span><?=$arResult["PROPERTIES"]["LINK_SOURCE"]["VALUE"]?>
					</span>
					<?
						}
					?>
					<div style="clear:both;float;none;"></div>				
					<div class="itemRatingBlock">
						<span>Оцените материал</span>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"ajax1",
	Array(
		"DISPLAY_AS_RATING" => "vote_avg",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $arResult['ID'],
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => array(),
		"SET_STATUS_404" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"]
	),
$component
);?>					</div>					
				<!-- Item Author -->
				<?
					if($arResult["PROPERTIES"]["author"]["VALUE"] != "")
					{
				?>
					<span class="itemAuthor">
						Автор&nbsp;<a rel="author" href=""><?=$arResult["PROPERTIES"]["author"]["VALUE"]?></a>
					</span>		
				<?
					}
				?>					
					<div style="clear:both;float;none;"></div>				
					<div class="vozmozhnosti_wrapper" >
						<div class="vozmozhnosti">	
							<div class="shrift"><span class="razmer">размер шрифта</span><span class="minus">-</span><span class="plus">+</span></div>
							<a href="<?=$APPLICATION->GetCurUri("print=Y")?>" target="_blank" class="pechat">Печать</a>
						</div>
					</div>
			</div>
			<?
				if($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null || $arResult["PROPERTIES"]["VIDEO"]["VALUE"] != "")
				{
			?>
			
			<link href="<?=SITE_TEMPLATE_PATH?>/css/default2.css" rel="stylesheet" type="text/css" />
			<script src="<?=SITE_TEMPLATE_PATH?>/js/mobilyslider2.js" type="text/javascript"></script>
			<script src="<?=SITE_TEMPLATE_PATH?>/js/init2.js" type="text/javascript"></script>
			<div class="pikachoose"> 	
				<div class="mimages">
				<?
				if($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null)
				{
				if(count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]) == 1){
				
				 $result_image_big = "/upload/fotonews/result_image_big".$arResult['ID'].".png";
				 $dc_result_image1 = $_SERVER["DOCUMENT_ROOT"].$result_image_big;
				 if(!file_exists($dc_result_image1)){
				 
					 CFile::ResizeImageFile(
						 $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]),
						 $dc_result_image1,
						 array(),
						 BX_RESIZE_IMAGE_PROPORTIONAL,
						 array(
							 "type" => "image", 
							 "file" => $_SERVER["DOCUMENT_ROOT"]."/upload/big_water.png",
							 "size" => "real", 
							 "alpha_level" => 100, // 0 - 100
							 "position" => "br",
							 "fill" => 'repeat', // resize | repeat
						 )
					 );
				}elseif(file_exists($dc_result_image1)){
					$result_image_big = "/upload/fotonews/result_image_big".$arResult['ID'].".png";
				}
					$result_image_small = "/upload/fotonews/result_image_small".$arResult['ID'].".png";
					 $dc_result_image2 = $_SERVER["DOCUMENT_ROOT"].$result_image_small;
				 if(!file_exists($dc_result_image2)){
				 
					 CFile::ResizeImageFile(
						 $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]),
						 $dc_result_image2,
						 array('width'=>340, 'height'=>255),
						 BX_RESIZE_IMAGE_PROPORTIONAL,
						 array(
							 "type" => "image", 
							 "file" => $_SERVER["DOCUMENT_ROOT"]."/upload/mini_water.png",
							 "size" => "real", 
							 "alpha_level" => 100, // 0 - 100
							 "position" => "br",
							 "fill" => 'repeat', // resize | repeat
						 )
					 );
				}
				elseif(file_exists($dc_result_image2)){
					$result_image_small = "/upload/fotonews/result_image_small".$arResult['ID'].".png";
				}
				?>
					<a class="fancybox" href="<?=$result_image_big;?>" data-fancybox-group="gallery"><img class="preview_picture" border="0"  src="<?=$result_image_small;?>" width="340" height="255"/></a>	
				<?}
				else{
				?>
					<div class="slider slider3">
						<div class="sliderContent">
				<?
				for($ii = 0; $ii < count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]);$ii++)
				{
					
				
				//формируем водяной знак на анонсных и на основных картинках
				$result_image_big = "/upload/fotonews/result_image_big$ii".$arResult['ID'].".png";
				 $dc_result_image1 = $_SERVER["DOCUMENT_ROOT"].$result_image_big;
				 if(!file_exists($dc_result_image1)){
				 
					 CFile::ResizeImageFile(
						 $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]),
						 $dc_result_image1,
						 array(),
						 BX_RESIZE_IMAGE_PROPORTIONAL,
						 array(
							 "type" => "image", 
							 "file" => $_SERVER["DOCUMENT_ROOT"]."/upload/big_water.png",
							 "size" => "real", 
							 "alpha_level" => 100, // 0 - 100
							 "position" => "br",
							 "fill" => 'repeat', // resize | repeat
						 )
					 );
				}elseif(file_exists($dc_result_image1)){
					$result_image_big = "/upload/fotonews/result_image_big$ii".$arResult['ID'].".png";
				}
					$result_image_small = "/upload/fotonews/result_image_small$ii".$arResult['ID'].".png";
					 $dc_result_image2 = $_SERVER["DOCUMENT_ROOT"].$result_image_small;
				 if(!file_exists($dc_result_image2)){
				 
					 CFile::ResizeImageFile(
						 $_SERVER["DOCUMENT_ROOT"].CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]),
						 $dc_result_image2,
						 array('width'=>340, 'height'=>255),
						 BX_RESIZE_IMAGE_PROPORTIONAL,
						 array(
							 "type" => "image", 
							 "file" => $_SERVER["DOCUMENT_ROOT"]."/upload/mini_water.png",
							 "size" => "real", 
							 "alpha_level" => 100, // 0 - 100
							 "position" => "br",
							 "fill" => 'repeat', // resize | repeat
						 )
					 );
				}
				elseif(file_exists($dc_result_image2)){
					$result_image_small = "/upload/fotonews/result_image_small$ii".$arResult['ID'].".png";
				}
				?>	
					<div class="item">
					<a class="fancybox" href="<?=$result_image_big;?>" data-fancybox-group="gallery"><img class="preview_picture" border="0"  src="<?=$result_image_small;?>" width="340" height="255"/></a>					
					</div>
				<?
				}			
				?>	
						</div>
					</div>
				<?}?>
				<?}?>
				</div>
				<?
					if($arResult["PROPERTIES"]["VIDEO"]["VALUE"] != "")
					{
				?>
					<span class="mvideo">
						<?=htmlspecialchars_decode($arResult["PROPERTIES"]["VIDEO"]["VALUE"])?>
					</span>		
				<?
					}
				?>				
			</div> 
			<?
				}
			?>
<div class="text" id="qaz">
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	
</div>
<br/>
<div style="clear:both;float;none;"></div>

<script type="text/javascript" src="//yandex.st/share/share.js"
charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,lj,gplus"
></div> 

<div class="itemContentFooter">		
	<span class="itemHits">
		Всего просмотров: <b><?=$arResult["SHOW_COUNTER"];?></b>			
	</span>
</div>
<br/>
<?
if($arResult['TAGS'] != null)
{
?>
<div class="itemTags">
Теги:
<?
	$mass_tags = explode(",",$arResult['TAGS']);
	foreach($mass_tags as $ch)
	{?>
		<a href="http://<?=$_SERVER['SERVER_NAME']?>/news-tags.php?tags=<?=$ch?>"><?=$ch?></a>
	<?}
?>
	  </div>
	  <?
	  }
	  ?>

			<div class="itemTagsBlock">
				<span class="tegi"></span>
					<ul class="itemTags">
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<?if($pid == "THEME" && count($arResult["ITEMS_THEME"]) > 0 ):?>
							<li>
							<?//=GetMessage("T_NEWS_DETAIL_THEME")?>Темы:&nbsp;
								<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
								<?=implode(",&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
							<?else:?>
								<?=$arProperty["DISPLAY_VALUE"];?>
							<?endif?>			
							</li>
						<?endif?>
					<?endforeach;?>
					</ul>
				<div style="clear:both;float;none;"></div>
			</div>
</div>

 <?$APPLICATION->IncludeFile(
				SITE_DIR."include/right.php",
				array(),
				array("MODE" => "html")
			);?> 