<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

$config = \Bitrix\Main\Web\Json::encode($arResult['CONFIG']);
?>
<div class="form-group">
    <label data-bx-user-consent="<?=htmlspecialcharsbx($config)?>" class="main-user-consent-request custom-control custom-checkbox">
    	<input type="checkbox" value="Y" <?=($arParams['IS_CHECKED'] ? 'checked' : '')?> name="<?=htmlspecialcharsbx($arParams['INPUT_NAME'])?>" class="custom-control-input">
    	<a class="custom-control-label"><?=htmlspecialcharsbx($arResult['INPUT_LABEL'])?></a>
    </label>
</div>
<script type="text/html" data-bx-template="main-user-consent-request-loader">
	<div class="main-user-consent-request-popup">
		<div class="main-user-consent-request-popup-cont">
            <div class="l-section">
                <div class="l-section__head">
                    <h2 data-bx-head="" class="l-section__title"></h2>
                </div>
    			<div class="main-user-consent-request-popup-body">
    				<div data-bx-loader="" class="main-user-consent-request-loader">
    					<svg class="main-user-consent-request-circular" viewBox="25 25 50 50">
    						<circle class="main-user-consent-request-path" cx="50" cy="50" r="20" fill="none" stroke-width="1" stroke-miterlimit="10"></circle>
    					</svg>
    				</div>
    				<div data-bx-content="" class="main-user-consent-request-popup-content">
    					<div class="main-user-consent-request-popup-textarea-block">
    						<textarea data-bx-textarea="" class="main-user-consent-request-popup-text" disabled></textarea>
    					</div>
    					<div class="main-user-consent-request-popup-buttons">
    						<span data-bx-btn-accept="" class="btn btn-primary">Y</span>
    						<span data-bx-btn-reject="" class="btn btn-light">N</span>
    					</div>
    				</div>
    			</div>
            </div>
        </div>
	</div>
</script>
