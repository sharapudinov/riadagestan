<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"])):
?>
<div class="b-foot-social">
    <?php foreach($arResult["SOCSERV"] as $socserv): ?>
    <a class="b-foot-social__item b-foot-social__item--<?=$socserv['CLASS']?>" href="<?=htmlspecialcharsbx($socserv["LINK"])?>">
        <?=Loc::getMessage('SS_FOOT_NAME_'.strtoupper($socserv['CLASS']))?>
    </a>
    <?php endforeach; ?>
</div>
<?php
endif;
