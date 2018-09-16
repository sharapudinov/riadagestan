<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("phpdag:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/mobile/",
	"SECTION_PAGE_URL" => "news/#SECTION_CODE#/",
	"DETAIL_PAGE_URL" => "news/#SECTION_CODE#/#ELEMENT_ID#",
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "2",
	"DEPTH_LEVEL" => "2",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);