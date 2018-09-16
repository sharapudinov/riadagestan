<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//test_dump($USER,$arResult);
$this->setFrameMode(true)?>
<div class="news-detail">
	<img class="detail_picture" border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="220" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<div class="desc_th">
		<div class="zagolovok_fon">
			<h2 class="zagolovok_text"><?=$arResult["NAME"]?></h2>
		</div>
		<span><?=$arResult["PREVIEW_TEXT"]?></span>
	</div>
</div>
