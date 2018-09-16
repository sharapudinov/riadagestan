<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    $this->setFrameMode(true);
/*     test_dump($arResult);*/
?>

<? if ($arParams["USE_RSS"] == "Y"): ?>
    <?
    $rss_url = str_replace(
        array(
            "#SECTION_ID#",
            "#SECTION_CODE#"
        )
        ,
        array(
            urlencode($arResult["VARIABLES"]["SECTION_ID"]),
            urlencode($arResult["VARIABLES"]["SECTION_CODE"])
        )
        ,
        $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss_section"]
    );
    if (method_exists(
        $APPLICATION,
        'addheadstring'
    ))
        $APPLICATION->AddHeadString(
            '<link rel="alternate" type="application/rss+xml" title="' . $rss_url . '" href="' . $rss_url . '" />'
        );
    ?>
    <!--<a href="<?= $rss_url ?>" title="rss" target="_self"><img alt="RSS" src="<?= $templateFolder ?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>-->
<? endif ?>
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "horizontal_multilevel",
    array(
        "ROOT_MENU_TYPE"        => "top",
        "MENU_CACHE_TYPE"       => "Y",
        "MENU_CACHE_TIME"       => "3600000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS"   => array(),
        "MAX_LEVEL"             => "1",
        "CHILD_MENU_TYPE"       => "top",
        "USE_EXT"               => "Y",
        "DELAY"                 => "N",
        "ALLOW_MULTI_SELECT"    => "N"
    ),
    $component
); ?>
<?
    GLOBAL $mainNewsFilter;
    switch (SITE_ID)
    {
        case 's1':
        {
            $iblock_id = 2;
            $mainNewsFilter = 'arrFilter22';
            break;
        }
        case 's2':
        {
            $iblock_id = 16;
            $mainNewsFilter = 'arrFilter23';
        }
    }

    $obCache = new CPHPCache();
    if ($obCache->InitCache(
        3600000,
        $iblock_id . $arResult['VARIABLES']['SECTION_CODE']
    )
    )
    {
        $vars = $obCache->GetVars();
        $section = $vars['section'];
    } else
    {
        $arFilter = Array(
            "IBLOCK_ID" => $iblock_id,
            'CODE'      => $arResult['VARIABLES']['SECTION_CODE']
        );
        $dbSec = CIBlockSection::GetList(
            array(),
            $arFilter
        );
        $section = $dbSec->GetNext();
    }

    $obCache->StartDataCache();
    $obCache->EndDataCache(array('section' => $section));

$obSec=CIBlockSection::GetList(array(),array('CODE' => $arResult["VARIABLES"]["SECTION_CODE"],'IBLOCK_ID'=>$iblock_id));

if(!$sec=$obSec->Fetch()) LocalRedirect('/404.php');?>

<div class="left">
    <? if ($section["IBLOCK_SECTION_ID"] == 94 || $section['ID'] == '94'): ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "municipalities",
            Array(
                "IBLOCK_TYPE"         => "",
                "IBLOCK_ID"           => "2",
                "SECTION_ID"          => '',
                "SECTION_CODE"        => "municipalities",
                "SECTION_URL"         => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "COUNT_ELEMENTS"      => "N",
                "TOP_DEPTH"           => "2",
                "SECTION_FIELDS"      => array(),
                "SECTION_USER_FIELDS" => array(),
                "ADD_SECTIONS_CHAIN"  => "Y",
                "CACHE_TYPE"          => "Y",
                "CACHE_TIME"          => "3600000",
                "CACHE_NOTES"         => "",
                "CACHE_GROUPS"        => "Y"
            ),
            $component
        );
        ?>

    <? else: ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "glav_news",
            array(
                "IBLOCK_TYPE"                     => "",
                "IBLOCK_ID"                       => $iblock_id,
                "NEWS_COUNT"                      => "19",
                "SORT_BY1"                        => "ACTIVE_FROM",
                "SORT_ORDER1"                     => "DESC",
                "SORT_BY2"                        => "SORT",
                "SORT_ORDER2"                     => "ASC",
                "FILTER_NAME"                     => $mainNewsFilter,
                "FIELD_CODE"                      => array(
                    0 => "ID",
                    1 => "",
                ),
                "PROPERTY_CODE"                   => array(
                    0 => "m_data",
                    1 => "IMAGES",
                    2 => "",
                ),
                "CHECK_DATES"                     => "Y",
                "DETAIL_URL"                      => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "AJAX_MODE"                       => "N",
                "AJAX_OPTION_JUMP"                => "N",
                "AJAX_OPTION_STYLE"               => "N",
                "AJAX_OPTION_HISTORY"             => "N",
                "CACHE_TYPE"                      => "A",
                "CACHE_TIME"                      => "360000",
                "CACHE_FILTER"                    => "Y",
                "CACHE_GROUPS"                    => "Y",
                "PREVIEW_TRUNCATE_LEN"            => "",
                "ACTIVE_DATE_FORMAT"              => "d.m.Y H:i",
                "SET_TITLE"                       => "Y",
                "SET_STATUS_404"                  => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN"       => "Y",
                "ADD_SECTIONS_CHAIN"              => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
                "PARENT_SECTION"                  => "",
                "PARENT_SECTION_CODE"             => "",
                "INCLUDE_SUBSECTIONS"             => "Y",
                "DISPLAY_TOP_PAGER"               => "N",
                "DISPLAY_BOTTOM_PAGER"            => "N",
                "PAGER_TITLE"                     => "Новости",
                "PAGER_SHOW_ALWAYS"               => "Y",
                "PAGER_TEMPLATE"                  => "",
                "PAGER_DESC_NUMBERING"            => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL"                  => "Y",
                "DISPLAY_DATE"                    => "Y",
                "DISPLAY_NAME"                    => "Y",
                "DISPLAY_PICTURE"                 => "Y",
                "DISPLAY_PREVIEW_TEXT"            => "Y",
                "DISPLAY_IMG_WIDTH"               => "136",
                "DISPLAY_IMG_HEIGHT"              => "101",
                "USE_RSS"                         => "Y",
                "TITLE_RSS"                       => "Главные новости информационного портала",
                "AJAX_OPTION_ADDITIONAL"          => "glav"
            ),
            $component
        ); ?>
    <? endif ?>
</div>


<? if ($arResult['VARIABLES']['SECTION_CODE'] == 'persons')
{
    $section_for_template = 'persons';
    $iblock_id = 24;
    $template = 'persons';
    $sort = 'NAME';
    $sort_order = 'ASC';
    $zagolovok_text = 'Персоны';
    $count = 1500;
} else
{
    $iblock_id = $arParams["IBLOCK_ID"];
    $sort = $arParams["SORT_BY1"];
    $sort_order = $arParams["SORT_ORDER1"];
    $zagolovok_text = $section['NAME'];
    $count = $arParams["NEWS_COUNT"];
}
?>
<div class="center-lenta" style="float: left">
    <div class="lenta_novostey_news_spisok">
        <div class="zagolovok_fon">
            <h2 class="zagolovok_text">
                <?= $zagolovok_text ?>
            </h2>
        </div>
    </div>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        $template,
        Array(
            "IBLOCK_TYPE"                     => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID"                       => $iblock_id,
            "NEWS_COUNT"                      => $count,
            "SORT_BY1"                        => $sort,
            "SORT_ORDER1"                     => $sort_order,
            "SORT_BY2"                        => $arParams["SORT_BY2"],
            "SORT_ORDER2"                     => $arParams["SORT_ORDER2"],
            "FIELD_CODE"                      => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE"                   => $arParams["LIST_PROPERTY_CODE"],
            "DISPLAY_PANEL"                   => $arParams["DISPLAY_PANEL"],
            "SET_TITLE"                       => $arParams["SET_TITLE"],
            "SET_STATUS_404"                  => $arParams["SET_STATUS_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN"       => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
            "ADD_SECTIONS_CHAIN"              => $arParams["ADD_SECTIONS_CHAIN"],
            "CACHE_TYPE"                      => $arParams["CACHE_TYPE"],
            "CACHE_TIME"                      => $arParams["CACHE_TIME"],
            "CACHE_FILTER"                    => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS"                    => $arParams["CACHE_GROUPS"],
            "DISPLAY_TOP_PAGER"               => $arParams["DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER"            => $arParams["DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE"                     => $arParams["PAGER_TITLE"],
            "PAGER_TEMPLATE"                  => $arParams["PAGER_TEMPLATE"],
            "PAGER_SHOW_ALWAYS"               => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_DESC_NUMBERING"            => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL"                  => $arParams["PAGER_SHOW_ALL"],
            "DISPLAY_DATE"                    => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME"                    => "Y",
            "DISPLAY_PICTURE"                 => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT"            => $arParams["DISPLAY_PREVIEW_TEXT"],
            "PREVIEW_TRUNCATE_LEN"            => $arParams["PREVIEW_TRUNCATE_LEN"],
            "ACTIVE_DATE_FORMAT"              => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "USE_PERMISSIONS"                 => $arParams["USE_PERMISSIONS"],
            "GROUP_PERMISSIONS"               => $arParams["GROUP_PERMISSIONS"],
            "FILTER_NAME"                     => $arParams["FILTER_NAME"],
            "HIDE_LINK_WHEN_NO_DETAIL"        => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
            "CHECK_DATES"                     => $arParams["CHECK_DATES"],
            "PARENT_SECTION"                  => $arResult["VARIABLES"]["SECTION_ID"],
            "PARENT_SECTION_CODE"             => $arResult["VARIABLES"]["SECTION_CODE"],
            "DETAIL_URL"                      => $arResult["FOLDER"] . $section_for_template . '/' . $arResult["URL_TEMPLATES"]["detail"],
            "DISPLAY_IMG_WIDTH"               => $arParams["DISPLAY_IMG_WIDTH"],
            "DISPLAY_IMG_HEIGHT"              => $arParams["DISPLAY_IMG_HEIGHT"],
            "DISPLAY_IMG_MEDIUM_WIDTH"        => $arParams["DISPLAY_IMG_MEDIUM_WIDTH"],
            "DISPLAY_IMG_MEDIUM_HEIGHT"       => $arParams["DISPLAY_IMG_MEDIUM_HEIGHT"],
        ),
        $component
    ); ?>
</div>

<script type="text/javascript">
    if (docLoaded) {
        //scrollObj.reset();
        $(".right_news_spisok").css('margin-top', 5);
        $('.news_item1').css('margin-top', 5);
        scrollObj = new _scroll();
        scrollObj.defineScrollable();
        $(window).off('scroll');
        $(window).on('scroll', function () {
            scrollObj.scrollMenu();
            scrollObj.scrollContent();
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
    }
</script>
