<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
IncludeTemplateLangFile(__FILE__);
?>
<?if(count($arResult["ITEMS"]) > 0):?>
<div class='box'>
    <div class="media_block_head"><h1><?=GetMessage("News_wire")?></h1><span class="now"></span></div>
    <ul class="lenta-news">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
		$mdate = get_date($arItem["DISPLAY_ACTIVE_FROM"]);//моя функция она в файле init.php
	?>
	    <li>
	        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
	            <span class="time-text blue"><?=$mdate["time"]?><br/><?=$mdate["day"]?>.<?=$mdate["month_num"]?>.<?=$mdate["year_num"]?></span>
	            <?=$arItem["NAME"]?>
	        </a>
	    </li>
	<?endforeach;?>
    </ul>
    <div class="pager_bottom">
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
    </div>
</div>
 <div class="clear"></div>
<?endif;?>

