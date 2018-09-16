<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if(count($arResult["ITEMS"]) > 0):?>
<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="zagolovok_fon"><h2 class="zagolovok_text"><?=$arItem["PREVIEW_TEXT"]?></h2></div>
		<?=$arItem["~DETAIL_TEXT"]?>
<?endforeach;?>
<?endif;?>
