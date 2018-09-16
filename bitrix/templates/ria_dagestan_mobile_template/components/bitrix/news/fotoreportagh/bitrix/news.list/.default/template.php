<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<div class='box'>
    <div class="media_block_head"><h1>Фоторепортаж</h1></div>
		<div class="photo_block_wrapper">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="photo_block">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<img title="<?=$arItem["NAME"]?>" alt="" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
			<p><?=$arItem["NAME"]?></p>
		</a>
	</div>
<?endforeach;?>
</div>	
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
