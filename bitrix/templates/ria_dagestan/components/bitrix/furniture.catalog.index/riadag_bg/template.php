<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->SetFrameMode(true);
//var_dump($arResult);
?>
<style>
    .bg  {
        width: 100%;
        height: 100%;
        z-index: -1;
/*
        position: fixed;
*/
        background: url('<?=$arResult['ITEMS'][1]['PICTURE']['SRC']?>') no-repeat center top;
    }
</style>

