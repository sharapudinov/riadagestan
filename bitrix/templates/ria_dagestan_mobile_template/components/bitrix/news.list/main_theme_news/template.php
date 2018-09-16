<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?IncludeTemplateLangFile(__FILE__);?>
<div class="box">
    <div class="media_block_head"><h1><?=GetMessage("other1")?></h1></div>
    <ul class="lenta-news">
<?foreach($arResult["ITEMS"] as $arItem):
    $date = get_date($arItem["DISPLAY_ACTIVE_FROM"]);?>
    <li>
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
            <span class="time-text blue"><?=$date["day"]?>.<?=$date["month_num"]?>.<?=$date["year_num"]?><br/><?=$date["time"]?></span>
            <?=$arItem["NAME"]?>
        </a>
    </li>
<?endforeach;?>
    </ul>
</div>
