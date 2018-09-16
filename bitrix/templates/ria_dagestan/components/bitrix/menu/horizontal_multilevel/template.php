<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true); ?>
<? if (!empty($arResult)): ?>
    <nav id="menu-wrap">
        <ul id="menu">
            <?
            $previousLevel = 0;

            $podd = "N";
            foreach ($arResult as $arItem):?>



            <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
                <?= str_repeat(($podd?"</ul>":"")."</li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
            <? endif?>
            <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                <?if($arItem["TEXT"] != "Муниципалитеты")
                    $podd = true;
                else $podd=false;
                ?>
                <li id="<?= $arItem["SELECTED"] ? 'aktiv' : '' ?>" class="menu-zagolovok" r="1">
                <a href="<?= $arItem["LINK"] ?>"
                   class="<?= $arItem["SELECTED"] ? 'root-item-selected' : 'root-item' ?>">
                    <?= $arItem["TEXT"] ?>
                </a>

            <? else: ?>
                    <?if($podd):?>
                <li<? if ($arItem["SELECTED"]): ?> class="item-selected"<? endif ?>>
                    <a href="<?= $arItem["LINK"] ?>" class="parent">
                        <?= $arItem["TEXT"] ?>
                    </a>
                </li>
                        <?endif?>
            <? endif?>

            <? if ($arItem["IS_PARENT"] && $podd): ?>
            <ul class="pod-menu" >
                <? endif ?>
                <? $previousLevel = $arItem["DEPTH_LEVEL"];?>

                <? endforeach ?>

                <? if ($previousLevel > 1)://close last item tags?>
                    <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
                <? endif ?>

            </ul>
    </nav>
    <div class="line"></div>
    <div id="menu-zaglushka"></div>
<? endif ?>