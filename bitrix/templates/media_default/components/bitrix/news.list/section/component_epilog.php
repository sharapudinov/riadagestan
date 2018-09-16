<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
//\Bitrix\Main\Diag\Debug::Dump($request->isAjaxRequest());
if (
    $request->get('isAjax') == 'Y' &&
    $request->isAjaxRequest()
) {
    global $APPLICATION;

    if (
        $request->get('action') == 'navigation' &&
        $request->get('id') == $arResult['SECTION_BLOCK_ID']
    ) {
        $arJson = array(
            'content' => $templateData['content']
        );

        if (isset($arResult['NAV_PARAMS'])) {
          $arJson['navParams'] = $arResult['NAV_PARAMS'];
        }

        $APPLICATION->RestartBuffer();
        echo Bitrix\Main\Web\Json::encode($arJson);
        die();
    } elseif (
        $request->get('action') == 'mm' &&
        $arParams['RS_TEMPLATE'] == 'mm'
    ) {
        $arJson = array(
            'content' => $templateData['content'],
            'template' => $arParams['RS_TEMPLATE']
        );

        $APPLICATION->RestartBuffer();
        echo Bitrix\Main\Web\Json::encode($arJson);
        die();
    }
}
