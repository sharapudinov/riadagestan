<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?='<?xml version="1.0" encoding="'.SITE_CHARSET.'"?>'?>
<rss version="2.0"<?if($arParams["YANDEX"]) echo ' xmlns="http://backend.userland.com/rss2" xmlns:yandex="http://news.yandex.ru"';?>>
<channel>
<title><?=$arResult["NAME"].(strlen($arResult["SECTION"]["NAME"])>0?" / ".$arResult["SECTION"]["NAME"]:"")?></title>
<link><?="http://".$arResult["SERVER_NAME"]?></link>
<description><?=strlen($arResult["SECTION"]["DESCRIPTION"])>0?$arResult["SECTION"]["DESCRIPTION"]:$arResult["DESCRIPTION"]?></description>
	<yandex:logo>https://riadagestan.ru/images/logo 100x100.png</yandex:logo>
	<yandex:logo type="square">http://riadagestan.ru/images/logo 180x180.png.png</yandex:logo>
<lastBuildDate><?=date("r")?></lastBuildDate>
<ttl><?=$arResult["RSS_TTL"]?></ttl>
<?if(is_array($arResult["PICTURE"])):?>
<image>
	<title><?=$arResult["NAME"]?></title>
	<url><?="https://".$arResult["SERVER_NAME"].$arResult["PICTURE"]["SRC"]?></url>
	<link><?="https://".$arResult["SERVER_NAME"]?></link>
	<width><?=$arResult["PICTURE"]["WIDTH"]?></width>
	<height><?=$arResult["PICTURE"]["HEIGHT"]?></height>
</image>
<?endif?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<item>
	<title><?=$arItem["title"]?></title>
	<link><?=$arItem["link"]?></link>
	<?
		// $arItem["description"] = strip_tags($arItem["description"]);
		//$mpos = strpos($arItem["description"],".");
		// if($mpos != null)
		// $arItem["description"] = substr($arItem["description"],0, $mpos);htmlspecialchars_decode($str, ENT_NOQUOTES);

		$arItem["description"] = strip_tags(htmlspecialchars_decode(htmlspecialchars_decode($arItem["description"], ENT_NOQUOTES)));
		$arItem["description"] = htmlspecialchars_decode($arItem["description"]);
		$arItem["description"] = htmlspecialchars($arItem["description"]);

		$mpos = strpos($arItem["full-text"],".");
		if($mpos != null)
		$arItem["description"] = substr($arItem["full-text"],0,$mpos);

	?>
	<description><?=$arItem["description"]?>.</description>
	
	<?if(is_array($arItem["enclosure"])):?>
		<enclosure url="<?=$arItem["enclosure"]["url"]?>" length="<?=$arItem["enclosure"]["length"]?>" type="<?=$arItem["enclosure"]["type"]?>"/>
	<?endif?>
	<?if($arItem["category"]):?>
		<category><?=$arItem["category"]?></category>
	<?endif?>
	<?if($arParams["YANDEX"]):?>
		<yandex:full-text><?=$arItem["full-text"]?></yandex:full-text>
	<?endif?>
	<pubDate><?=$arItem["pubDate"]?></pubDate>
</item>
<?endforeach?>
</channel>
</rss>
