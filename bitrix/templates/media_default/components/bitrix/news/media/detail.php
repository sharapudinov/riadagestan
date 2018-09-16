<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

$this->setFrameMode(true);
$APPLICATION->SetPageProperty('disable-wrapper', 'Y');
?>
<div class="l-page l-page--detail-news has-container has-sidebar">
    <div class="l-page__row sticky-content">
        <div class="l-page__main">
            <div class="l-section">
                <?php
                $APPLICATION->AddBufferContent(function () use  ($APPLICATION) {
                    return include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/breadcrumb.php';
                });
                ?>
                <div class="l-news-detail" itemscope itemtype="http://schema.org/NewsArticle">
                    <?php $APPLICATION->ShowViewContent('rs_news_detail_before'); // from news.detail ?>
                    <?php
                    $elementId = $APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "news",
                        Array(
                            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                            "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
                            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                            "META_KEYWORDS" => $arParams["META_KEYWORDS"],
                            "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
                            "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
                            "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
                            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                            "SET_TITLE" => $arParams["SET_TITLE"],
                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                            "SHOW_404" => $arParams["SHOW_404"],
                            "FILE_404" => $arParams["FILE_404"],
                            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                            "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                            "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                            "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                            "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
                            "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
                            "CHECK_DATES" => $arParams["CHECK_DATES"],
                            "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                            "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                            "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                            "USE_SHARE" => $arParams["USE_SHARE"],
                            "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                            "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                            "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                            "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                            "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                            "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
                            'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
                            "SORT_BY1" => $arParams["SORT_BY1"],
                            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                            "SORT_BY2" => $arParams["SORT_BY2"],
                            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                            "RS_LINKED_PROPS" => $arParams["RS_LINKED_PROPS"],
                            "RS_PROP_VIDEO" => $arParams["RS_DETAIL_PROP_VIDEO"],
							"RS_PROP_SOURCES" => isset($arParams["RS_DETAIL_PROP_SOURCES"]) ? $arParams["RS_DETAIL_PROP_SOURCES"] : '-',
                            "RS_USE_ELEMENT_NAVIGATION" => $arParams['RS_DETAIL_USE_ELEMENT_NAVIGATION'],
                            "USE_SHARE" => $arParams['RS_DETAIL_USE_SHARE'],
                            "RS_SHARE_SOCIALS" => $arParams['RS_DETAIL_SHARE_SOCIALS']
                        ),
                        $component
                    );
                    ?>
                </div>
                <div class="l-section__bottom">
                    <?php $APPLICATION->ShowViewContent('rs_news_detail_bottom'); // from news.detail ?>
                </div>
            </div>
            <?php $APPLICATION->ShowViewContent('rs_news_detail_after'); // from news.detail ?>
            <?php
            if ($arParams['RS_DETAIL_USE_COMMENTS'] == 'Y') {

				if ($arParams['RS_DETAIL_COMMENTS_TYPE'] == 'vk') {
					?>
					<!-- Put this script tag to the <head> of your page -->
					<script type="text/javascript" src="//vk.com/js/api/openapi.js?126"></script>
					<script type="text/javascript">
					  VK.init({apiId: <?=$arParams["RS_DETAIL_COMMENTS_VK_CODE"];?>, onlyWidgets: true});
					</script>
					<!-- Put this div tag to the place, where the Comments block will be -->
					<div id="vk_comments" style="margin-top: 30px;"></div>
					<script>
					VK.Widgets.Comments("vk_comments", {redesign: 1, limit: 10, attach: "*"});
					</script>
					<?php
				} else {
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.comments",
						"news",
						array(
							'ELEMENT_ID' => $elementId,
							'ELEMENT_CODE' => '',
							'IBLOCK_ID' => $arParams['IBLOCK_ID'],
							'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
							'URL_TO_COMMENT' => '',
							'WIDTH' => '',
							'COMMENTS_COUNT' => '5',
							'BLOG_USE' => 'Y',
							'FB_USE' => $arParams['FB_USE'],
							'FB_APP_ID' => $arParams['FB_APP_ID'],
							'VK_USE' => $arParams['VK_USE'],
							'VK_API_ID' => $arParams['VK_API_ID'],
							'CACHE_TYPE' => $arParams['CACHE_TYPE'],
							'CACHE_TIME' => $arParams['CACHE_TIME'],
							'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
							'BLOG_TITLE' => '',
							'BLOG_URL' => $arParams['RS_DETAIL_COMMENTS_BLOG_CODE'],
							'PATH_TO_SMILE' => '',
							'EMAIL_NOTIFY' => 'Y',
							'AJAX_POST' => 'Y',
							'SHOW_SPAM' => 'Y',
							'SHOW_RATING' => 'N',
							'FB_TITLE' => '',
							'FB_USER_ADMIN_ID' => '',
							'FB_COLORSCHEME' => 'light',
							'FB_ORDER_BY' => 'reverse_time',
							'VK_TITLE' => '',
							'USER_CONSENT' => $arParams['RS_DETAIL_COMMENTS_USE_CONSENT'],
							'USER_CONSENT_ID' => $arParams['RS_DETAIL_COMMENTS_CONSENT_ID']
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);
				}
            }
            ?>
        </div>
        <aside class="l-page__sidebar">
            <?php include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/sidebar.php'; ?>
        </aside>
    </div>
</div>
