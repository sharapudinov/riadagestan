<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="itemHeader">		
<!-- Item title -->
	<h1 class="itemTitle"><?=$arResult["NAME"]?></h1>
	<!-- Date created -->
		<span class="itemDateCreated">
			<?=$arResult["DISPLAY_ACTIVE_FROM"]?>	
		</span>
		<div style="clear:both;float;none;"></div>				
		<div class="itemRatingBlock">
			<span><?$APPLICATION->IncludeComponent(
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
);?>	</span>				
	 </div>	
	<div style="clear:both;float;none;"></div>			
</div>
			<?
				if($arResult["PROPERTIES"]["images_reportagh"]["VALUE"] != null)
				{?>
					<div class="fotorep_vnt">
					<?  for($ii = 0; $ii < count($arResult["PROPERTIES"]["images_reportagh"]["VALUE"]);$ii++)
						{?>
				<div class="fotorep_block">
					<a class="fancybox" href="<?=CFile::GetPath($arResult["PROPERTIES"]["images_reportagh"]["VALUE"][$ii]);?>" data-fancybox-group="gallery"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["images_reportagh"]["VALUE"][$ii]);?>"/></a><p></p>
					</div>
						<?}?>
					</div>
				<?}
			?>
	<div style="clear:both;float;none;"></div>
	<script type="text/javascript" src="//yandex.st/share/share.js"
charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,lj,gplus"

></div> 