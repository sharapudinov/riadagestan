<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.right_news_spisok{display: none;}
.zagolovok_fon{display: none;}
</style>
<script>
$(document).ready(function(){
	$('.video_block iframe').attr({"width":"294","height":"210"});
});
</script>
<div class="video_vnt">

<div class='box'>
    <div class="media_block_head"><h1>Видеорепортажи</h1></div>
		<div class="media_block_wrapper">
<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="media_block">
            <div class="e_video_wrapper">
        		<? 
					$video_view = str_replace("ifr ame", "iframe", $arItem["PROPERTIES"]["video_iframe"]["VALUE"]);
					$video_view = str_replace("</ifr>", "</iframe>", $video_view);
				?>
				<?=htmlspecialchars_decode($video_view)?>
            </div>
                <p><?=$arItem["NAME"]?></p>  
        </div>
<?endforeach;?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>