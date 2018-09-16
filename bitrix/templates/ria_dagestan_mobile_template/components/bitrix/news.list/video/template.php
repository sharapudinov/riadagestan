<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
IncludeTemplateLangFile(__FILE__);
if(count($arResult["ITEMS"]) > 0):
?>
<script>
 $(document).ready(function(){
	$('.media_block iframe').attr({"width":"320","height":"226"})
 });
</script>	
<div class="box">
    <div class="media_block_head"><h1><?=GetMessage("title")?></h1><a href="/mobile/video/" class="m_more"><?=GetMessage("all")?></a></div>
    <div class="media_block">
<?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="e_video_wrapper">
		       <!-- --><?/*
					$video_view1 = str_replace("ifr ame", "iframe", $arItem["PROPERTIES"]["video_iframe"]["VALUE"]);
					$video_view1 = str_replace("</ifr>", "</iframe>", $video_view1);
					$video_view1 = str_replace("//", "http://", $video_view1);
				*/?>
				<?=htmlspecialchars_decode($arItem["PROPERTIES"]["video_iframe"]["VALUE"])?>
        </div>
        <p><?=$arItem["NAME"]?></p>  
<?endforeach;?>
	</div>
</div>
<?endif;?>
