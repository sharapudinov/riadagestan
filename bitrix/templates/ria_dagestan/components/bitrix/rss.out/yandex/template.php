<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?='<?xml version="1.0" encoding="'.SITE_CHARSET.'"?>'?>
<rss version="2.0"<?if($arParams["YANDEX"]) echo ' xmlns="http://backend.userland.com/rss2" xmlns:yandex="http://news.yandex.ru"';?>>
<channel>
<title>Республиканское Информационно Агентство "Дагестан"</title>
<link><?="http://".$arResult["SERVER_NAME"]?></link>
<description><?=strlen($arResult["SECTION"]["DESCRIPTION"])>0?$arResult["SECTION"]["DESCRIPTION"]:$arResult["DESCRIPTION"]?></description>
	

<image>
	<title>Республиканское Информационно Агентство "Дагестан"</title>
	<url><?="http://".$arResult["SERVER_NAME"]?>/logo.gif</url>
	<link><?="http://".$arResult["SERVER_NAME"]?></link>
</image>

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
		$fulltext = $arItem["description"];
		
		$mpos = strpos($arItem["description"],".");
		if($mpos != null)
		$arItem["description"] = substr($arItem["description"],0,$mpos);
		
	?>
	<description><?=$arItem["description"]?>.</description>
	<pubDate><?=$arItem["pubDate"]?></pubDate>
	
	<?if(is_array($arItem["enclosure"])):?>
		<enclosure url="<?=$arItem["enclosure"]["url"]?>" length="<?=$arItem["enclosure"]["length"]?>" type="<?=$arItem["enclosure"]["type"]?>"/>
	<?endif?>

	<category><?=$arItem["category"]?></category>

	<yandex:full-text><?=$fulltext?>.</yandex:full-text>
	

</item>
<?endforeach?>
</channel>
</rss>
