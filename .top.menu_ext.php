<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(SITE_TEMPLATE_ID=='ria_dagestan')$seo_folder='/news/';
if(SITE_TEMPLATE_ID=='ria_dagestan_mobile_template')$seo_folder='/mobile_news/';

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("phpdag:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => '/',
	"SECTION_PAGE_URL" => "news/#SECTION_CODE#/",
	"DETAIL_PAGE_URL" => "news/#SECTION_CODE#/#ELEMENT_ID#",
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "2",
	"DEPTH_LEVEL" => "2",
	"CACHE_TYPE" => "Y",
	"CACHE_TIME" => "360000",
	"CACHE_GROUPS" => "N"
	),
	false
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);