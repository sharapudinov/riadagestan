<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$protocol = $request->isHttps() ? 'https://' : 'http://';

$this->setFrameMode(false);
echo '<?xml version="1.0" encoding="'.SITE_CHARSET.'"?>';
?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss">
    <channel>
        <title><?=$arResult["NAME"].(strlen($arResult["SECTION"]["NAME"])>0?" / ".$arResult["SECTION"]["NAME"]:"")?></title>
        <link><?=$protocol.$arResult["SERVER_NAME"]?></link>
        <description><?=strlen($arResult["SECTION"]["DESCRIPTION"])>0?$arResult["SECTION"]["DESCRIPTION"] : $arResult["DESCRIPTION"]?></description>
        <language><?=LANGUAGE_ID;?></language>
        <?php foreach($arResult["ITEMS"] as $arItem): ?>
        <item>
            <title><?=$arItem["title"]?></title>
            <link><?=$arItem["link"]?></link>
            <pubDate><?=$arItem["pubDate"]?></pubDate>
            <media:rating scheme="urn:simple">nonadult</media:rating>
            <?php if (isset($arResult['USERS']) && isset($arResult['USERS'][$arItem['ELEMENT']['CREATED_BY']])): $arUser = $arResult['USERS'][$arItem['ELEMENT']['CREATED_BY']] ?>
            <author>
            <?php
            if (isset($arUser['NAME']) && isset($arUser['LAST_NAME'])) {
                echo $arUser['NAME'].' '.$arUser['LAST_NAME'];
            } else {
                echo $arUser['LOGIN'];
            }
            ?>
            </author>
            <?php endif; ?>
            <?php if ($arItem['enclosure']): ?>
            <enclosure url="<?=$arItem['enclosure']['url']?>" type="<?=$arItem['enclosure']['type']?>"/>
            <?php endif; ?>
            <description><![CDATA[
                <?=$arItem["description"]?>
            ]]></description>
            <content:encoded><![CDATA[
				<?=$arItem['ELEMENT']['DETAIL_TEXT'];?>
			]]></content:encoded>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>
