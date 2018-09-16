<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["BANNER"]=preg_replace('/width="[1-9]+"/','width="100%"',$arResult["BANNER"]);
$arResult["BANNER"]=preg_replace('/height="[1-9]+"/','',$arResult["BANNER"]);
echo $arResult["BANNER"];
?>