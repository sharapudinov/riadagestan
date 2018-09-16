<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$menuBlockId = !empty($arParams['RS_MENU_ID']) ? $arParams['RS_MENU_ID'] : 'mainMenu';

$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.ui.js');

if (!empty($arResult)):
?>
<div class="l-main-menu" id="<?=$menuBlockId?>">
    <?php
    foreach($arResult as $arItem):   ?>
    <div class="b-main-menu-item<?php if ($arItem['PARAMS']['FROM_IBLOCK']): ?> has-dropdown<?php endif; ?> <?php if ($arItem["SELECTED"]):?> is-current<?php endif; ?>">
        <a href="<?=$arItem['LINK']?>" class="b-main-menu-item__link"><?=$arItem['TEXT']?></a>
        <?php if ($arItem['PARAMS']['FROM_IBLOCK']): ?>
        <div class="b-main-menu-item__dropdown is-fullwidth">
            <div class="l-mm-catalog-items">
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <div class="b-main-menu-item is-more has-dropdown">
        <a href="#" class="b-main-menu-item__link"><?=Loc::getMessage('RS_MORE_LINK');?></a>
        <div class="b-main-menu-item__dropdown"></div>
    </div>
</div>
<script>
  var <?=$menuBlockId.'Obj'?> = new RS.MainMenu('<?=$menuBlockId?>');
</script>
<?php endif;
