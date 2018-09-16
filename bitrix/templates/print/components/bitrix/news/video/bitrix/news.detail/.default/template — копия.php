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

<div class="news-detail">
	<? //print_r($arResult);?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
	
	<div class="news-picture">
	<?echo $arResult["SECTION"]["PATH"][0]["NAME"]?>
		<h1><?=$arResult["NAME"]?></h1>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"ajax",
	Array(
		"IBLOCK_TYPE" => "photos",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $arResult['ID'],
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => array(),
		"SET_STATUS_404" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_NOTES" => ""
	),
$component
);?>
<?=$arResult["SHOW_COUNTER"];?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	</div>
	<?endif?>
	

	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<div class="news-text">
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
	<div style="clear:both"></div>

	<?foreach($arResult["FIELDS"] as $code=>$value):?>
		<?if ($code != 'PREVIEW_PICTURE'):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
		<?endif?>
	<?endforeach;?>
	
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<?if($pid != "THEME"):?>
			<div class="news-property"><?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</div>
		<?endif?>
	<?endforeach;?>
		<div class="news-property">
			<?=GetMessage("T_NEWS_SHORT_URL");
			$shortPageURL = (CMain::IsHTTPS()) ? "https://" : "http://";
			$host = (SITE_SERVER_NAME == "") ?  $_SERVER['HTTP_HOST'] : SITE_SERVER_NAME;
			$shortPageURL.= htmlspecialcharsbx($host).CBXShortUri::GetShortUri($arResult["~DETAIL_PAGE_URL"]);
			?>
			<a href="<?=$shortPageURL?>"><?=$shortPageURL?></a>
		</div>
	</div>
	<div class="news-detail-back"><a href="<?=$arResult["SECTION_URL"]?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a></div>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<?if($pid == "THEME" && count($arResult["ITEMS_THEME"]) > 0 ):?>
			<div class="news-detail-theme">
			<div class="news-theme-title"><?=GetMessage("T_NEWS_DETAIL_THEME")?>:&nbsp;
				<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode(",&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</div>
			<?foreach($arResult["ITEMS_THEME"] as $pid=>$arProperty):?>
				<div class="news-theme-item"><div class="news-theme-date"><?=$arProperty["ACTIVE_FROM"]?></div><div class="news-theme-url"><a href="<?=$arProperty["DETAIL_PAGE_URL"]?>"><?=$arProperty["NAME"]?></a></div></div>
			<?endforeach;?>
			<div class="br"></div>
			</div>
		<?endif?>
	<?endforeach;?>
	
	
</div>
