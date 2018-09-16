<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true) ?>
<div class="left">
    <div class="glav_novosti">
        <div class="zagolovok_fon"><h2 class="zagolovok_text">Муниципалитеты</h2></div>
        <ul class="municipalities_ul">
            <?
            //SECTION_PAGE_URL
            //CODE
            //municipalities

            $pod_sec = "N";

            foreach ($arResult["SECTIONS"] as $arSection):?>

                    <div class="municipalities">
                        <li class="municipalities_item">
                            <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["NAME"] ?></a>
                        </li>
                    </div>
            <? endforeach ?>
        </ul>
    </div>
</div>