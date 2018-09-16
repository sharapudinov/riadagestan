<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$mobile = is_set($_COOKIE['mobile']) ? $_COOKIE['mobile'] : (mobile_detect() ? 'Y' : 'N');
if ($mobile == 'Y')
    LocalRedirect('/mobile' . $APPLICATION->GetCurPage());
$curDir = $APPLICATION->GetCurDir();
?>
<? IncludeTemplateLangFile(__FILE__); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#">
<head>
    <meta name="sputnik-verification" content="NmWXmWtr6LeOJEe3"/>
    <title><?= GetMessage("title") . ' '; ?><? $APPLICATION->ShowTitle() ?></title>
    <? $APPLICATION->ShowHead(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.5">
    <meta name="yandex-verification" content="85428359f4dabae9"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico"/>

    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/fancybox/jquery.fancybox.css") ?>
    <? if ($curDir == SITE_DIR): ?>
        <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/datepicker_style.css") ?>
        <? if (SITE_ID == "s1"): ?>
            <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/datepicker_js.js") ?>
        <? elseif (SITE_ID == "s2"): ?>
            <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/datepicker_js_m.js") ?>
        <? endif; ?>
        <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/datepicker.js") ?>
        <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/instafeed/instafeed.js") ?>
    <? endif ?>
    <? $APPLICATION->ShowCSS() ?>
    <? CJSCore::Init(array("jquery")); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox/jquery.fancybox.pack.js'); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/my.js") ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.cookie.js") ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/html5.js") ?>
    <!--[if IE]>
    <style type="text/css">
        .clear {
            zoom: 1;
            display: block;
        }
    </style>
    <![endif]-->


    <!--[if lte IE 7]>
    <![endif]-->
    <script type="text/javascript">
        var docLoaded = false;
        $(document).ready(function () {
            docLoaded = true;
        });
        var onScroll = function () {
        }
    </script>
    <!--    <script src="<? /*=SITE_TEMPLATE_PATH*/ ?>/RHBanner.js" type="text/javascript"></script>
--><!--    --><? /* $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/RHBanner.js") */ ?>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?= 'https://' . $_SERVER['SERVER_NAME'] . $APPLICATION->GetCurPage() ?>"/>
    <meta property="og:title" content="<? $APPLICATION->ShowTitle() ?>"/>
    <meta property="og:image:url" content="<? $APPLICATION->ShowViewContent('shared_image_path') ?>"/>
</head>
<body class="bg">
<? $APPLICATION->ShowPanel(); ?>
<!--<div class="bg"></div>-->
<div class="all">
    <header>
        <div class="header_left">
            <div class="date-header">
                <?
                if (SITE_ID == "s1") {
                    $img = "logotip2";
                    Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("aria"); ?>
                    <?= get_today_date(); ?>
                    <? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("aria", get_today_date());

                } elseif (SITE_ID == "s2") {
                    $img = "logo-eng";
                    Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("aria"); ?>
                    <?= get_today_date_en(); ?>
                    <? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("aria", get_today_date_en());
                }
                ?>
            </div>
            <div class="logotip"><a href="/"><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $img ?>.jpg"/></a></div>
            <div class="slogan"><p><?= GetMessage("Republican") ?><br/><?= GetMessage("information") ?>
                    <br/><?= GetMessage("agency") ?></p></div>
        </div>
        <div class="header_right">
            <div class="header_line">
                <div class="soc-seti">
                    <noindex>
                        <a rel="nofollow" href="https://www.facebook.com/groups/riadagestan/" target="_blank">
                            <div class="facebook"></div>
                        </a>
                        <a rel="nofollow" href="https://t.me/riadagestan" target="_blank">
                            <div class="telegram"></div>
                        </a>
                        <a rel="nofollow" href="https://twitter.com/riadagestan" target="_blank">
                            <div class="twitter"></div>
                        </a>
                        <a rel="nofollow" href="https://www.instagram.com/riadagestan.ru/" target="_blank">
                            <div class="instagram"></div>
                        </a>
                        <a rel="nofollow" href="http://vkontakte.ru/riadagestan" target="_blank">
                            <div class="vk"></div>
                        </a>
                        <a rel="nofollow" href="http://www.odnoklassniki.ru/riadagestan" target="_blank">
                            <div class="ok"></div>
                        </a>
                        <a rel="nofollow" href="https://plus.google.com/" target="_blank">
                            <div class="google"></div>
                        </a>

                        <a rel="nofollow" href="http://www.youtube.com/user/riadagestan2" target="_blank">
                            <div class="youtube"></div>
                        </a>
                        <a rel="nofollow" href="http://<?= $_SERVER['HTTP_HOST'] ?>/rss.php" target="_blank">
                            <div class="mrss"></div>
                        </a>
                    </noindex>
                </div>

                <a href="#">
                    <div class="dosput asd"></div>
                </a>

                <div class="poisk">
                    <form action="/search/" method="get" id="search-block-form">
                        <div class="form-item">
                            <input type="text" name="q" value="" size="15" maxlength="128"
                                   placeholder="<?= GetMessage("search"); ?>" x-webkit-speech="" speech=""
                                   autocomplete="off">
                        </div>
                        <div class="form-actions">
                            <input type="submit" id="edit-submit" name="op" value="" class="form-submit">
                        </div>
                        <input type="hidden" name="how" value="r">
                    </form>
                </div>
                <? if (SITE_ID == 's1'): ?>
                    <noindex>
                        <a rel="nofollow" class="en" href="//riadagestan.com">
                    </noindex>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/en.jpg"/>
                    </a>
                <? else: ?>
                    <noindex>
                        <a class="en" rel="nofollow" href="//riadagestan.ru">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/ru.jpg"/>
                        </a>
                    </noindex>
                <? endif ?>
            </div>
            <div class="header-img">
                <?
                if (SITE_ID == "s1")
                    $banner_top = "TOP";
                elseif (SITE_ID == "s2")
                    $banner_top = "TOP_EN";
                ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "top",
                    array(
                        "TYPE" => "TOP",
                        "NOINDEX" => "Y",
                        "CACHE_TYPE" => "Y",
                        "CACHE_TIME" => "360000"
                    ),
                    false
                ); ?>
                <? //BEGIN фильтры для новостных блоков?>
                <? //Главные новости
                $arrFilter22 = array(
                    "IBLOCK_ID" => 2,
                    "ACTIVE" => "Y",
                    "PROPERTY_MYFILTER_VALUE" => "1",
                );
                ?>
                <? //Главные новости
                $arrFilter23 = array(
                    "IBLOCK_ID" => 16,
                    "ACTIVE" => "Y",
                    "PROPERTY_MAIN_NEWS_VALUE" => "1",
                );
                ?>
                <? //END фильтры для новостных блоков?>

            </div>
        </div>
    </header>
    <? if (str_replace("/news/", '', $curDir) == $curDir && str_replace("/news_en/", '', $curDir) == $curDir): ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "horizontal_multilevel",
            array(
                "ROOT_MENU_TYPE" => "top",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "3600000",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => array(),
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "COMPONENT_TEMPLATE" => "horizontal_multilevel",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
        ); ?>

    <? endif ?>
    <div class="main">
