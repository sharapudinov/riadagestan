<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (count($arResult["ITEMS"]) > 0):
    ?>
    <div class="interviy">
        <div class="zagolovok_fon"><h2 class="zagolovok_text"><?= GetMessage("head"); ?></h2>

            <div class="vse_temi"><a href="/news/interview/"><?= GetMessage("all"); ?></a></div>
        </div>

        <ul class="b-side-col__layout">
            <? foreach ($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));

                $mdate = $arItem["DISPLAY_ACTIVE_FROM"]; //$arItem["DISPLAY_ACTIVE_FROM"];
                $mdate = mmdate($mdate);//моя функция она в файле init.php
                if ($mdate == "1") $mdate = $arItem["PROPERTIES"]["m_data"]["VALUE"];

                ?>
                <?
                if ($arItem["PROPERTIES"]["IMAGES"]["VALUE"][0] != null):
                    ?>
                    <li class="b-side-col__anons-item">
                        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">

                            <img src="<?= $arItem['PREVIEW_IMG_MEDIUM']['SRC']; ?>"
                                 width="<?= $arParams["DISPLAY_IMG_WIDTH"] ?>"
                                 height="<?= $arParams["DISPLAY_IMG_HEIGHT"] ?>" border="0"
                                 alt="<?= $arItem["NAME"] ?>"/>

                        </a>
                        <span><?echo $mdate;?></span>

                        <p><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?= $arItem["NAME"] ?></a></p>
                    </li>
                <?
                else:
                    ?>
                    <li class="b-side-col__anons-item">
                        <span><?echo $mdate;?></span>

                        <p><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?= $arItem["NAME"] ?></a></p>
                    </li>
                <?
                endif;
                ?>
            <? endforeach;?>
        </ul>
    </div>
<? endif; ?>
