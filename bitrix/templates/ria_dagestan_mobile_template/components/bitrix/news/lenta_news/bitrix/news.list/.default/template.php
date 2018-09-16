<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$component->SetResultCacheKeys(array('SECTION'));

?>

<div class='box'>
    <div id="makeMeScrollable">
        <?
        $mass = $arResult["SECTION"]["PATH"]["0"];
        $arFilter = Array('IBLOCK_ID' => $mass["IBLOCK_ID"], 'SECTION_ID' => $mass["ID"]);
        $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true);

        while ($ar_result = $db_list->GetNext()) {
            ?>
            <p><a href="mobile_news<?= $ar_result['SECTION_PAGE_URL'] ?>"><?= $ar_result['NAME'] ?></a></p>
        <?
        }
        ?>
    </div>
    <div id="ipad_submenu">
        <?
        $mass = $arResult["SECTION"]["PATH"]["0"];
        $arFilter = Array('IBLOCK_ID' => $mass["IBLOCK_ID"], 'SECTION_ID' => $mass["ID"]);
        $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true);

        while ($ar_result = $db_list->GetNext()) {
            ?>
            <p><a href="/mobile_news<?= $ar_result['SECTION_PAGE_URL'] ?>"><?= $ar_result['NAME'] ?></a></p>
        <?
        }
        ?>
    </div>

</div>
<div class='box'>
    <div class="media_block_head">
        <?
        $curDir = $APPLICATION->GetCurDir();
        if (str_replace('/mobile_news/news', '', $curDir) != $curDir) {
            ?>
            <h1>
                <?
                if ($arResult["SECTION"]["PATH"][1]["NAME"] == null):
                    echo $arResult["SECTION"]["PATH"][0]["NAME"];
                else:
                    echo $arResult["SECTION"]["PATH"][1]["NAME"];
                endif;
                ?>
            </h1>
        <?
        }
        ?>
        <span class="now"></span></div>
    <ul class="lenta-news">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $mdate = get_date($arItem["DISPLAY_ACTIVE_FROM"]);//моя функция она в файле init.php
            ?>
            <li>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                    <span class="time-text blue"><?= $mdate["time"] ?><br/><?= $mdate["day"] ?>
                        .<?= $mdate["month_num"] ?>.<?= $mdate["year_num"] ?></span>
                    <?= $arItem["NAME"] ?>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
    <div class="pager_bottom">
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
    </div>
</div>
<div class="clear"></div>