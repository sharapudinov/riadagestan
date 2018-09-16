<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//test_dump($USER,$arResult["SECTION"]);
$this->setFrameMode(true);
$component->SetResultCacheKeys(array('SECTION'));
?>
<div class='box'>
    <ul class="lenta-news">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $mdate = get_date($arItem["DISPLAY_ACTIVE_FROM"]);//моя функция она в файле init.php?>
            
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