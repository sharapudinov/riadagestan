<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loader::includeModule('redsign.media');

$this->setFrameMode(true);

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$protocol = $request->isHttps() ? 'https://' : 'http://';
$host = $request->getHttpHost();
?>

<?php $this->SetViewTarget('rs_news_detail_before'); ?>
    <div class="b-news-detail-top">
        <h1 class="page-title" itemprop="name headline"><?=$arResult['NAME']?></h1>
        <div class="b-news-detail-top-meta">
            <div class="b-news-detail-top-meta__left">

                <?php if ($arResult['AUTHOR']): ?>
                    <?php if (isset($arResult['AUTHOR']['AVATAR'])): ?>
                    <div class="b-meta-item b-meta-item--avatar">
                        <img src="<?=$arResult['AUTHOR']['AVATAR']?>" alt="" title="">
                    </div>
                    <?php endif; ?>

                    <div class="b-meta-item b-meta-item--bold" itemprop="author" itemscope itemtype="http://schema.org/Person">
                        <span itemprop="name">
                        <?php
                        if (isset($arResult['AUTHOR']['NAME'])) {
                           echo $arResult['AUTHOR']['NAME'];
                        }
                        if (isset($arResult['AUTHOR']['LAST_NAME'])) {
                            echo ' '.$arResult['AUTHOR']['LAST_NAME'];
                        }
                        ?>
                        </span>
                    </div>
                <?php endif; ?>

                <div class="d-none" itemprop="publisher<?php if (!isset($arResult['AUTHOR'])): ?> author<?php endif; ?>" itemscope="" itemtype="https://schema.org/Organization">
                    <?php $APPLICATION->IncludeFile('include/microdata/organization.php', array(), array('SHOW_BORDER' => false)); ?>
                </div>

                <?php if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
                <time class="b-meta-item" datetime="<?=ConvertDateTime($arResult["ACTIVE_FROM"], 'YYYY-MM-DD')?>" itemprop="datePublished"><span class="fa fa-clock-o"></span> <?=$arResult["DISPLAY_ACTIVE_FROM"]?></time>
                <?php endif; ?>

                <link itemprop="mainEntityOfPage" href="<?=isset($arResult['CANONICAL_PAGE_URL']) ? $arResult['CANONICAL_PAGE_URL'] : $arResult['DETAIL_PAGE_URL']?>">
                <meta itemprop="dateModified" content="<?=ConvertDateTime($arResult["TIMESTAMP_X"], 'YYYY-MM-DD')?>">
            </div>

            <div class="b-news-detail-top-meta__right">
                <div class="b-meta-item" style="vertical-align: middle;">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:iblock.vote",
                        "media_stars",
                        array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "ELEMENT_ID" => $arResult["ID"],
                            "MAX_VOTE" => $arParams["MAX_VOTE"],
                            "VOTE_NAMES" => $arParams["VOTE_NAMES"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
                            "SHOW_RATING" => "Y",
                        ),
                        $component
                    );?>
                </div>
                <?php if (isset($arResult['SHOW_COUNTER'])): ?>
                <div class="b-meta-item"><i class="fa fa-eye" aria-hidden="true"></i> <?=$arResult["SHOW_COUNTER"]?></div>
                <?php endif; ?>
                <?php if (!empty($arResult['READING_TIME'])): ?>
                <div class="b-meta-item"><span class="fa fa-bookmark"></span> <?=$arResult['READING_TIME']?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    if ($arParams['USE_SHARE'] == 'Y') {
        \Redsign\Media\MediaTemplate::showShareLinks($arParams['RS_SHARE_SOCIALS'], ['full'], $arResult['RS_SHARE_CONTENT']);
    }
    ?>
<?php $this->EndViewTarget(); ?>

<div class="b-news-detail-body js-news-detail" itemprop="articleBody">
<?php if (isset($arResult['DISPLAY_PROPERTIES'][$arParams['RS_PROP_VIDEO']])): ?>
  <div class="content-full-width">
    <div class="b-news-detail-body__video"><?=$arResult['DISPLAY_PROPERTIES'][$arParams['RS_PROP_VIDEO']]['DISPLAY_VALUE']?></div>
</div>
<?php elseif (isset($arResult['DETAIL_PICTURE']['SRC'])): ?>
    <div class="b-news-detail-body__picture" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <div class="content-full-width">
            <img src="<?=$arResult['EMPTY_IMAGE_SRC']?>" data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="is-lazy-img" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
        </div>
        <link itemprop="contentUrl url" href="<?=$protocol.$host.$arResult['DETAIL_PICTURE']['SRC']?>">
        <meta itemprop="width" content="<?=$arResult['DETAIL_PICTURE']['WIDTH']?>">
        <meta itemprop="height" content="<?=$arResult['DETAIL_PICTURE']['HEIGHT']?>">
        <meta itemprop="description" content="<?=$arResult['DETAIL_PICTURE']['DESCRIPTION']?>">
        <?php if (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) > 0): ?>
            <meta itemprop="description" content="<?=$arResult['DETAIL_PICTURE']['DESCRIPTION']?>">
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php if($arResult["NAV_RESULT"]): ?>
    <?php if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><?php endif; ?>
    <?=$arResult['NAV_TEXT']?>
    <?php if($arParams["DISPLAY_BOTTOM_PAGER"]):?><?=$arResult["NAV_STRING"]?><?php endif; ?>
<?php elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
    <?=$arResult["DETAIL_TEXT"];?>
<?php elseif (strlen($arResult["PREVIEW_TEXT"]) > 0): ?>
    <?=$arResult['PREVIEW_TEXT']?>
<?php endif; ?>
</div>

<div class="d-block">
	<?php if(!empty($arResult['PROPERTIES'][$arParams['RS_PROP_SOURCES']]['VALUE'])): ?>
		<div class="news-detail-meta">
			<div class="news-detail-meta__item news-detail-meta__item--title"><span class="fa fa-link" aria-hidden="true"></span> <?=Loc::getMessage('RS_MEDIA_DETAIL_SOURCES'); ?></div>
			<?php
			foreach ($arResult['PROPERTIES'][$arParams['RS_PROP_SOURCES']]['VALUE'] as $index => $sSourceLink):
				if (isset($arResult['PROPERTIES'][$arParams['RS_PROP_SOURCES']]['DESCRIPTION'][$index])) {
					$sSourceName = $arResult['PROPERTIES'][$arParams['RS_PROP_SOURCES']]['DESCRIPTION'][$index];
				} else {
					$sSourceName = $sSourceLink;
				}
			?>
			<a href="<?=$sSourceLink?>" class="news-detail-meta__item"><?=$sSourceName?></a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (count($arResult['TAGS_ARRAY']) > 0): ?>
	<div class="news-detail-meta">
		<div class="news-detail-meta__item news-detail-meta__item--title"><span class="fa fa-tags" aria-hidden="true"></span> <?=Loc::getMessage('RS_MEDIA_DETAIL_TAGS'); ?></div>
		<?php foreach ($arResult['TAGS_ARRAY'] as $arTag): ?>
			<a href="<?=$arTag['LINK']?>" class="news-detail-meta__item"><?=$arTag['NAME']?></a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
</div>

<?php
$this->SetViewTarget('rs_news_detail_bottom');
if ($arParams['USE_SHARE'] == 'Y') {
    \Redsign\Media\MediaTemplate::showShareLinks($arParams['RS_SHARE_SOCIALS'], ['full', 'no-margin'], $arResult['RS_SHARE_CONTENT']);
}
$this->EndViewTarget();
?>

<?php $this->SetViewTarget('rs_news_detail_after'); ?>
<?php if ($arResult['NEXT_ELEMENT'] || $arResult['PREVIOUS_ELEMENT']): ?>
<div class="l-section">
    <div class="row">
        <div class="col-12 col-sm-6">
            <?php if ($arResult['PREVIOUS_ELEMENT']): ?>
            <div class="b-section-item b-section-item--sibling b-section-item--previous">
                <div class="b-section-item__picture">
                    <?php if (isset($arResult['PREVIOUS_ELEMENT']['PREVIEW_PICTURE']['SRC'])): ?>
                    <a href="<?=$arResult['PREVIOUS_ELEMENT']['DETAIL_PAGE_URL']?>">
                        <img src="<?=$arResult['EMPTY_IMAGE_SRC']?>" data-src="<?=$arResult['PREVIOUS_ELEMENT']['PREVIEW_PICTURE']['SRC']?>" class="is-lazy-img" alt="<?=$arResult['PREVIOUS_ELEMENT']['NAME']?>" alt="<?=$arResult['PREVIOUS_ELEMENT']['NAME']?>">
                        <div class="b-section-item__icon"></div>
                    </a>
                    <?php endif; ?>
                </div>
                <a href="<?=$arResult['PREVIOUS_ELEMENT']['DETAIL_PAGE_URL']?>" class="b-section-item__title">
                    <?=$arResult['PREVIOUS_ELEMENT']['NAME']?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-12 col-sm-6">
            <?php if ($arResult['NEXT_ELEMENT']): ?>
            <div class="b-section-item b-section-item--sibling b-section-item--next">
                <div class="b-section-item__picture">
                    <?php if (isset($arResult['NEXT_ELEMENT']['PREVIEW_PICTURE']['SRC'])): ?>
                    <a href="<?=$arResult['NEXT_ELEMENT']['DETAIL_PAGE_URL']?>">
                        <img src="<?=$arResult['EMPTY_IMAGE_SRC']?>" data-src="<?=$arResult['NEXT_ELEMENT']['PREVIEW_PICTURE']['SRC']?>" class="is-lazy-img" alt="<?=$arResult['NEXT_ELEMENT']['NAME']?>" alt="<?=$arResult['NEXT_ELEMENT']['NAME']?>">
                        <div class="b-section-item__icon"></div>
                    </a>
                    <?php endif; ?>
                </div>
                <a href="<?=$arResult['NEXT_ELEMENT']['DETAIL_PAGE_URL']?>" class="b-section-item__title">
                    <?=$arResult['NEXT_ELEMENT']['NAME']?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif;

if (is_array($arParams['RS_LINKED_PROPS'])) {
    foreach ($arParams['RS_LINKED_PROPS'] as $sPropCode) {
        if (
            !isset($arResult['PROPERTIES'][$sPropCode]) ||
            count($arResult['PROPERTIES'][$sPropCode]['VALUE']) == 0
        ) {
            continue;
        }

        global $arItemsFilter;
        $arItemsFilter = ['ID' => $arResult['PROPERTIES'][$sPropCode]['VALUE']];
        $nCountItems = count($arResult['PROPERTIES'][$sPropCode]['VALUE']);
        $sBlockName = $arResult['PROPERTIES'][$sPropCode]['NAME'];

        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "section",
            array(
                "ACTIVE_DATE_FORMAT" => $arParams['ACTIVE_DATE_FORMAT'],
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                "CACHE_TIME" => $arParams['CACHE_TIME'],
                "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                "CHECK_DATES" => $arParams['CHECK_DATES'],
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(),
                "FILTER_NAME" => "arItemsFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => $arProperty['LINK_IBLOCK_ID'],
                "IBLOCK_TYPE" => "",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => $nCountItems,
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_TITLE" => "",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => $arParams['PREVIEW_TRUNCATE_LEN'],
                "PROPERTY_CODE" => array(),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => $arParams['SORT_BY1'],
                "SORT_BY2" => $arParams['SORT_BY2'],
                "SORT_ORDER1" => $arParams['SORT_ORDER1'],
                "SORT_ORDER2" => $arParams['SORT_ORDER2'],
                "STRICT_SECTION_CHECK" => "Y",
                "SEARCH_PAGE" => $arParams['SEARCH_PAGE'],
                "USE_RATING" => $arParams['LIST_USE_RATING'],
                "USE_SHARE" => "N",
                "RS_TEMPLATE" => "slider",
                "RS_BLOCK_TITLE" => $sBlockName
            ),
            $this
        );
    }
}

$this->EndViewTarget();
