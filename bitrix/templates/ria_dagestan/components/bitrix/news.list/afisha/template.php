<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult["ITEMS"]) > 0):
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="kinoteatr"> 							
		<ul class="raspisanie-kino"> 
		<li class="nazvanie_kinoteatra"><b><?=$arItem["NAME"]?></b></li>
		<?if($arItem["PROPERTIES"]["session"]["VALUE"][0] != null):?>
		<?
			for($i1 = 0; $i1 < count($arItem["PROPERTIES"]["session"]["VALUE"]); $i1++)
			{?>		
				<li>
					<?
						$masssession = explode("@",$arItem["PROPERTIES"]["session"]["VALUE"][$i1]);
						if(count($masssession) == 2):?>
							<a href="<?=$masssession[1]?>" target="_blank"><p class="nazv"><?=$masssession[0]?></p></a>
						<?else:?>
							<p class="nazv"><?=$masssession[0]?></p>	
						<?endif;?>			
					<p class="e_time"><?=$arItem["PROPERTIES"]["session"]["DESCRIPTION"][$i1]?></p>
				</li>
		<?
			}
		?>
		<?endif?>

		</ul>
	</div>
<?endforeach;?>
<?endif;?>
