<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
IncludeTemplateLangFile(__FILE__);
if(count($arResult["ITEMS"]) > 0):
?>
<div class="box">
    <div class="media_block_head"><h1><?=GetMessage("title")?></h1><a href="/mobile/fotoreportagh/" class="m_more"><?=GetMessage("all")?></a></div>
    <div class="media_block">
<?foreach($arResult["ITEMS"] as $arItem):?>
 	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
        <img title="<?echo $arItem["NAME"]?>" alt="<?echo $arItem["NAME"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
        <p><?echo $arItem["NAME"]?></p>
    </a>
	<?break;?>
<?endforeach;?>
	</div>
</div>

<?endif;?>
