<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
        return;
    }
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<nav>
    <ul class="pagination justify-content-center">
<?if($arResult["bDescPageNumbering"] === true):?>

    <?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
        <?if($arResult["bSavePage"]):?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span>1</span></a></li>
        <?else:?>
            <?if (($arResult["NavPageNomer"]+1) == $arResult["NavPageCount"]):?>
                <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <?else:?>
                  <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <?endif?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span>1</span></a></li>
        <?endif?>
    <?else:?>
            <li class="page-item disabled"><a class="page-link" href="#"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <li class="page-item disabled"><a class="page-link" href="#"><span>1</span></a></li>
    <?endif?>

    <?
    $arResult["nStartPage"]--;
    while($arResult["nStartPage"] >= $arResult["nEndPage"]+1):
    ?>
        <?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

        <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <li class="page-item disabled"><a class="page-link" href="#"><span><?=$NavRecordGroupPrint?></span></a></li>
        <?else:?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><span><?=$NavRecordGroupPrint?></span></a></li>
        <?endif?>

        <?$arResult["nStartPage"]--?>
    <?endwhile?>

    <?if ($arResult["NavPageNomer"] > 1):?>
        <?if($arResult["NavPageCount"] > 1):?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span><?=$arResult["NavPageCount"]?></span></a></li>
        <?endif?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_forward")?></span></a></li>
    <?else:?>
        <?if($arResult["NavPageCount"] > 1):?>
            <li class="page-item"><a class="page-link" href="#"><span><?=$arResult["NavPageCount"]?></span></a></li>
        <?endif?>
            <li class="page-item disabled"><a class="page-link" href="#"><span><?echo GetMessage("round_nav_forward")?></span></a></li>
    <?endif?>

<?else:?>

    <?if ($arResult["NavPageNomer"] > 1):?>
        <?if($arResult["bSavePage"]):?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span>1</span></a></li>
        <?else:?>
            <?if ($arResult["NavPageNomer"] > 2):?>
                <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <?else:?>
                <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <?endif?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span>1</span></a></li>
        <?endif?>
    <?else:?>
            <li class="page-item disabled"><a class="page-link" href="#"><span><?echo GetMessage("round_nav_back")?></span></a></li>
            <li class="page-item disabled"><a class="page-link" href="#"><span>1</span></a></li>
    <?endif?>

    <?
    $arResult["nStartPage"]++;
    while($arResult["nStartPage"] <= $arResult["nEndPage"]-1):
    ?>
        <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <li class="page-item disabled"><a class="page-link" href="#"><span><?=$arResult["nStartPage"]?></span></a></li>
        <?else:?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><span><?=$arResult["nStartPage"]?></span></a></li>
        <?endif?>
        <?$arResult["nStartPage"]++?>
    <?endwhile?>

    <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
        <?if($arResult["NavPageCount"] > 1):?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><span><?=$arResult["NavPageCount"]?></span></a></li>
        <?endif?>
            <li class="page-item"><a class="page-link"href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_forward")?></span></a></li>
    <?else:?>
        <?if($arResult["NavPageCount"] > 1):?>
            <li class="page-item disabled"> <a class="page-link" href="#"><span><?=$arResult["NavPageCount"]?></span></a></li>
        <?endif?>
            <li class="page-item disabled"><a class="page-link" href="#"><span><?echo GetMessage("round_nav_forward")?></span></a></li>
    <?endif?>
<?endif?>

<?if ($arResult["bShowAll"]):?>
    <?if ($arResult["NavShowAll"]):?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><span><?echo GetMessage("round_nav_pages")?></span></a></li>
    <?else:?>
            <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><span><?echo GetMessage("round_nav_all")?></span></a></li>
    <?endif?>
<?endif?>
    </ul>
</nav>
