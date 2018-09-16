<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
?>
<div class="l-section">
    <div class="l-section__content">
        <div class="text-center">
            <span class="fa fa-envelope b-simple-subscribe-form-icon" aria-hidden="true" style="font-size:  2.5rem"></span>
            <h3 class="b-simple-subscribe-form-title"><?=Loc::getMessage('RS.SF_TITLE_TEXT');?></h3>
            <?php $frame = $this->createFrame('footersubscribe', false)->begin(); ?>
            <form action="<?=$arResult['FORM_ACTION']?>">
                <?php foreach ($arResult['RUBRICS'] as $itemID => $itemValue): ?>
                    <input class="d-none" type="checkbox" name="sf_RUB_ID[]" value="<?=$itemValue["ID"]?>"<?php if($itemValue["CHECKED"]) { echo ' checked'; }?> title="<?=$itemValue['NAME']?>">
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="b-simple-subscribe-form-input-wrap">
                        <input type="text" name="sf_EMAIL" size="20" value="" placeholder="<?=Loc::getMessage('RS.SF_EMAIL_PLACEHOLDER');?>" class="form-control text-center">
                    </div>
                </div>
                <div class="form-group">
                    <input name="OK" type="submit" class="btn btn-primary btn-block" value="<?=Loc::getMessage('RS.SF_SUBSCRIBE');?>">
                </div>
            </form>
            <?php $frame->beginStub(); ?>
            <form action="<?=$arResult['FORM_ACTION']?>">
                <?php foreach ($arResult['RUBRICS'] as $itemID => $itemValue): ?>
                    <input class="d-none" type="checkbox" name="sf_RUB_ID[]" value="<?=$itemValue["ID"]?>"<?php if($itemValue["CHECKED"]) { echo ' checked'; }?> title="<?=$itemValue['NAME']?>">
                <?php endforeach; ?>
                <div class="form-group">
                    <div class="b-simple-subscribe-form-input-wrap">
                        <input type="text" name="sf_EMAIL" size="20" value="" placeholder="<?=Loc::getMessage('RS.SF_EMAIL_PLACEHOLDER');?>" class="form-control text-center">
                    </div>
                </div>
                <div class="form-group">
                    <input name="OK" type="submit" class="btn btn-primary btn-block" value="<?=Loc::getMessage('RS.SF_SUBSCRIBE');?>">
                </div>
            </form>
            <?php $frame->end(); ?>
        </div>
    </div>
</div>
