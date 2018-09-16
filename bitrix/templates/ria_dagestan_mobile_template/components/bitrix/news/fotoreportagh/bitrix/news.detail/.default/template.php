<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

        <link href="<?=SITE_TEMPLATE_PATH?>/css/photoswipe.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/lib/simple-inheritance.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/lib/code-photoswipe-1.0.11.min.js"></script>



<script type="text/javascript">
    // Set up PhotoSwipe with all anchor tags in the Gallery container 
    document.addEventListener('DOMContentLoaded', function(){
        Code.photoSwipe('a', '#Gallery');
    }, false);
</script>
<div class='box'>
<div class="media_block_head"><h1>ФОТОРЕПОРТАЖ - <?=$arResult["NAME"]?></h1></div>
	<div class="media_block_wrapper">

        <div id="Gallery">
            <div class="gallery-row box">


				<?
					if($arResult["PROPERTIES"]["images_reportagh"]["VALUE"] != null)
					{?>
						<div class="fotorep_vnt1">
						<?  for($ii = 0; $ii < count($arResult["PROPERTIES"]["images_reportagh"]["VALUE"]);$ii++)
							{?>

							<div class="gallery-item">
	                            <a href="<?=CFile::GetPath($arResult["PROPERTIES"]["images_reportagh"]["VALUE"][$ii]);?>"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["images_reportagh"]["VALUE"][$ii]);?>" /></a>
	                            <p><?=$arResult["PROPERTIES"]["images_reportagh"]["DESCRIPTION"][$ii]?></p>
	                        </div>

							<?}?>
						</div>
					<?}
				?>
			</div>
	    </div>  
	      
	</div>
</div>