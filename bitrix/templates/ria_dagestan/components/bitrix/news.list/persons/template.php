<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    $this->setFrameMode(true);
    $component->SetResultCacheKeys(array('SECTION'));
?>
<div class="lenta_novostey_news_spisok">

    <ul class="b-mid-col__layout">
        <li class="person">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <? $first_literal = $arItem["NAME"][0] . $arItem["NAME"][1]; ?>
            <?
                $this->AddEditAction(
                    $arItem['ID'] . "_" . $q,
                    $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID(
                        $arItem["IBLOCK_ID"],
                        "ELEMENT_EDIT"
                    )
                );
                $this->AddDeleteAction(
                    $arItem['ID'] . "_" . $q,
                    $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID(
                        $arItem["IBLOCK_ID"],
                        "ELEMENT_DELETE"
                    )
                );
            ?>
            <? $classPict = ''; ?>

            <? if ($prev_first != $first_literal): ?>
            <? if ($first_literal != 'А'): ?>
        </li>
        <li class="person">
            <? endif ?>
            <div class="literal">
                <?= $first_literal ?>
            </div>

            <? endif ?>
            <span>
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"].',' ?></a>
                </span>
            <? $prev_first = $first_literal ?>
            <? endforeach; ?>
        </li>

        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
    </ul>
</div>