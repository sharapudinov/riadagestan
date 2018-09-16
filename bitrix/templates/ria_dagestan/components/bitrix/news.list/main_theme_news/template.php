<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true); ?>

<div class="theme-news-list">
    <table>

        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
            ?>
            <tr class="theme-news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <td><span class="news-date-time"><?= $arItem["ACTIVE_FROM"] ?></span></td>
                <td><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="theme"><?= $arItem["NAME"] ?></a></td>
            </tr>
        <? endforeach; ?>
    </table>

</div>