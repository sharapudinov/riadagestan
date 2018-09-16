<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.js');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/velocity/velocity.ui.js');

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

?>
<div class="l-popup-search" id="popup-search">
    <a href="#" class="l-popup-search__close js-search-conceal"><svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cross"></use></svg></a>
    <div class="l-popup-search__inner">
        <div class="container">
            <div id="<?echo $CONTAINER_ID?>">
                <form action="<?echo $arResult["FORM_ACTION"]?>" class="b-popup-search-form">
                    <input class="b-popup-search-form__input" id="<?echo $INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="<?=Loc::getMessage('RS_ST_SEARCH_ENTER');?>">
                    <input name="s" type="submit" value="<?=GetMessage("CT_BST_SEARCH_BUTTON");?>" class="d-none">
                    <button class="b-popup-search-form__btn">
                        <span class="fa fa-search"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        new JCTitleSearch({
    			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
    			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
    			'INPUT_ID': '<?echo $INPUT_ID?>',
    			'MIN_QUERY_LEN': 2
    		});
    });
</script>
<?php  $this->SetViewTarget('rs_mobile_search'); ?>
    <form action="<?=$arResult["FORM_ACTION"]?>" class="mobile-search">
        <label for="mobileSerachField" class="sr-only"><?=Loc::getMessage('RS_ST_SEARCH_SEARCH');?></label>
        <input id="mobileSerachField" class="form-control mobile-search__field" type="text"  placeholder="<?=Loc::getMessage('RS_ST_SEARCH_SEARCH');?>…" name="q" value="" size="15" maxlength="50">
        <button type="submit" class="btn btn-default"><?=Loc::getMessage('RS_ST_SEARCH_BUTTON');?></button>
    </form>
<?php $this->EndViewTarget(); ?>
