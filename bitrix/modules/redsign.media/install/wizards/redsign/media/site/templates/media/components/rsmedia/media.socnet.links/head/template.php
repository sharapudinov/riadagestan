<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.ui.js');

$this->setFrameMode(true);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"])):
?>
<div class="b-head-social">
    <a class="b-head-social__title" href="#"><span class="fa fa-plus" aria-hidden="true"></span><?=Loc::getMessage('SS_TITLE');?></a>
    <div class="b-head-social__group">
        <?php foreach($arResult["SOCSERV"] as $socserv): ?>
        <a class="b-head-social__item b-head-social__item--<?=$socserv['CLASS']?>" href="<?=htmlspecialcharsbx($socserv["LINK"])?>">
            <?=Loc::getMessage('SS_NAME_'.strtoupper($socserv['CLASS']))?>
        </a>
        <?php endforeach; ?>
    </div>
</div>
<?php
endif;
