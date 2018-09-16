    <? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    $this->setFrameMode(true);

    if ($arResult['VARIABLES']['SECTION_CODE'] == 'persons')
    {
        $section_for_template = 'persons';
        $iblock_id = 24;
        $iblock_type = 'lists';
        $template = 'persons';
        $sort = 'NAME';
        $sort_order = 'ASC';
        $zagolovok_text = 'Персоны';
        $template = 'person';
    } else
    {
        $iblock_type = $arParams["IBLOCK_TYPE"];
        $iblock_id = $arParams["IBLOCK_ID"];
        $sort = $arParams["SORT_BY1"];
        $sort_order = $arParams["SORT_ORDER1"];
        $zagolovok_text = $section['NAME'];
        $template='main';
    }
    $obSec=CIBlockSection::GetList(array(),array('CODE' => $arResult["VARIABLES"]["SECTION_CODE"],'IBLOCK_ID'=>$iblock_id));

    if(!$sec=$obSec->Fetch()) LocalRedirect('/404.php');?>

<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "horizontal_multilevel",
    array(
        "ROOT_MENU_TYPE"        => "top",
        "MENU_CACHE_TYPE"       => "A",
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
);

?>

<? $ElementID = $APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    $template,
    Array(
        "DISPLAY_DATE"              => $arParams["DISPLAY_DATE"],
        "DISPLAY_NAME"              => $arParams["DISPLAY_NAME"],
        "DISPLAY_PICTURE"           => $arParams["DISPLAY_PICTURE"],
        "DISPLAY_PREVIEW_TEXT"      => $arParams["DISPLAY_PREVIEW_TEXT"],
        "IBLOCK_TYPE"               => $iblock_type,
        "IBLOCK_ID"                 => $iblock_id,
        "FIELD_CODE"                => $arParams["DETAIL_FIELD_CODE"],
        "PROPERTY_CODE"             => $arParams["DETAIL_PROPERTY_CODE"],
        "DETAIL_URL"                => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
        "META_KEYWORDS"             => $arParams["META_KEYWORDS"],
        "META_DESCRIPTION"          => $arParams["META_DESCRIPTION"],
        "BROWSER_TITLE"             => $arParams["BROWSER_TITLE"],
        "DISPLAY_PANEL"             => $arParams["DISPLAY_PANEL"],
        "SET_TITLE"                 => $arParams["SET_TITLE"],
        "SET_STATUS_404"            => $arParams["SET_STATUS_404"],
        "MESSAGE_404"               => 'Новость не найдена',
        "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
        "ADD_SECTIONS_CHAIN"        => $arParams["ADD_SECTIONS_CHAIN"],
        "ACTIVE_DATE_FORMAT"        => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
        "CACHE_TYPE"                => $arParams["CACHE_TYPE"],
        "CACHE_TIME"                => $arParams["CACHE_TIME"],
        "CACHE_GROUPS"              => $arParams["CACHE_GROUPS"],
        "USE_PERMISSIONS"           => $arParams["USE_PERMISSIONS"],
        "GROUP_PERMISSIONS"         => $arParams["GROUP_PERMISSIONS"],
        "DISPLAY_TOP_PAGER"         => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER"      => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE"               => $arParams["DETAIL_PAGER_TITLE"],
        "PAGER_SHOW_ALWAYS"         => "N",
        "PAGER_TEMPLATE"            => $arParams["DETAIL_PAGER_TEMPLATE"],
        "PAGER_SHOW_ALL"            => $arParams["DETAIL_PAGER_SHOW_ALL"],
        "CHECK_DATES"               => $arParams["CHECK_DATES"],
        "ELEMENT_ID"                => $arResult["VARIABLES"]["ELEMENT_ID"],
        "ELEMENT_CODE"              => $arResult["VARIABLES"]["ELEMENT_CODE"],
        "IBLOCK_URL"                => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
        "USE_SHARE"                 => $arParams["USE_SHARE"],
        "SHARE_HIDE"                => $arParams["SHARE_HIDE"],
        "SHARE_TEMPLATE"            => $arParams["SHARE_TEMPLATE"],
        "SHARE_HANDLERS"            => $arParams["SHARE_HANDLERS"],
        "SHARE_SHORTEN_URL_LOGIN"   => $arParams["SHARE_SHORTEN_URL_LOGIN"],
        "SHARE_SHORTEN_URL_KEY"     => $arParams["SHARE_SHORTEN_URL_KEY"],
        "DISPLAY_IMG_DETAIL_WIDTH"  => $arParams["DISPLAY_IMG_DETAIL_WIDTH"],
        "DISPLAY_IMG_DETAIL_HEIGHT" => $arParams["DISPLAY_IMG_DETAIL_HEIGHT"],
        "SET_CANONICAL_URL"         => $arParams["DETAIL_SET_CANONICAL_URL"],
    ),
    $component
); ?>
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


