<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<link type="text/css" href="<?=SITE_TEMPLATE_PATH?>/slide-fancybox/basic.css" rel="stylesheet" /> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/slide-fancybox/jquery.pikachoose.js"></script>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/slide-fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/slide-fancybox/jquery.fancybox.js"></script>	
<script language="javascript">
	$(document).ready(function (){
	   var a = function(self){
		  // self.anchor.fancybox();
			var fancy = function(){
					var play=self.options.autoPlay;
					$('body').find('a.previmages,a.nextimages').remove();
					self.active.parents('li:first').prevAll().each(function(){
							var href=$(this).find('img').data('clickThrough');
							$('body').prepend($('<a>').attr({'href':href,'class':'previmages', 'rel':'gallery'}).css('display','none'));
					});
					self.active.parents('li:first').nextAll().each(function(){
							var href=$(this).find('img').data('clickThrough');
							$('body').append($('<a>').attr({'href':href,'class':'nextimages', 'rel':'gallery'}).css('display','none'));
					});
					self.anchor.attr('rel','gallery');
					$('a[rel=gallery]').fancybox({
							onStart:function(){if(play){self.imgPlay.trigger('click');}}
					});
			}
			self.anchor.bind('click',fancy);
			fancy();
	   };
	   $("#pikame").PikaChoose({buildFinished:a, autoPlay:true, showCaption:true, carousel:true});
	});
</script>

<script type="text/javascript">
	(function(){
	  var bsa = document.createElement('script');
		 bsa.type = 'text/javascript';
		 bsa.async = true;
		 bsa.src = '//s3.buysellads.com/ac/bsa.js';
	  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
	})();
</script>
<style>
ul#pikame li{float:left;}
ul#pikame li img{float:left; height:150px; margin:0px 5px 0px}
</style>
			<div class="itemHeader">
			<!-- Item title -->
							
				<!-- Date created -->
					<span class="itemDateCreated">
						<?=$arResult["DISPLAY_ACTIVE_FROM"]?>	
					</span>
				<!-- Item category -->
					<span class="itemCategory">
						<span>Опубликовано в&nbsp;</span><a href=""><?echo $arResult["SECTION"]["PATH"][0]["NAME"]?></a>
					</span>
					<div style="clear:both;float;none;"></div>				
					
				<!-- Item Author -->
					<span class="itemAuthor">
						Автор&nbsp;<a rel="author" href=""><?=$arResult["PROPERTIES"]["author"]["VALUE"]?></a>
					</span>					
					
			</div>
			<?
				if($arResult["PROPERTIES"]["IMAGES"]["VALUE"] != null)
				{
			?>
			<div class="pikachoose"> 
				<ul id="pikame"> 
				<?
						for($ii = 0; $ii < count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]);$ii++)
						{?>
							<li><a href="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]);?>"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]);?>"/></a><span></span></li> 
						<?}
				?>
				
				</ul> 
			</div> 
			<?
				}
			?><div style="clear:both;float;none;"></div>
<div class="text">
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

	<div class="itemContentFooter">		
		<span class="itemHits">
			Прочитано <b><?=$arResult["SHOW_COUNTER"];?></b> раз			
		</span>
	</div>
<div style="clear:both;float;none;"></div>

			<div class="itemTagsBlock">
				<span class="tegi">Теги</span>
					<ul class="itemTags">
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<?if($pid == "THEME" && count($arResult["ITEMS_THEME"]) > 0 ):?>
							<li>
							<?=GetMessage("T_NEWS_DETAIL_THEME")?>:&nbsp;
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