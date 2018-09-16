<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?$curDir=$APPLICATION->GetCurDir();
$canonical=str_replace('/mobile','',$curDir);
?>
<? $mobile = is_set($_COOKIE['mobile']) ? $_COOKIE['mobile'] : (mobile_detect() ? 'Y' : 'N');?>

<? IncludeTemplateLangFile(__FILE__); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "sputnik-verification" content = "NmWXmWtr6LeOJEe3"/>
    <title><?= GetMessage("title") ?> <? $APPLICATION->ShowTitle() ?></title>
    <? $APPLICATION->ShowHead(); ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico"/>
    <link rel="canonical" href="<?=$canonical?>">
    <meta name="generator" content="Responsive Web Css (www.responsivewebcss.com)"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.css') ?>
    <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/font-awesome.css') ?>

    <? CJSCore::Init(array("jquery")); ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.cookie.js") ?>
    <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-ui-1.8.23.custom.min.js'); ?>
    <?/* $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mousewheel.min.js'); */?><!--
    --><?/* $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.kinetic.js'); */?>

    <!--Google Analitics-->
    <?if (SITE_ID=='s1'):?>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-44078576-1', 'riadagestan.ru');
            ga('send', 'pageview');

        </script>
    <?else:?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-44078576-2', 'auto');
            ga('send', 'pageview');

        </script>
    <?endif?>
    <!--  /Google-->
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
</head>
<body>
<? if ($USER->isAdmin()) $APPLICATION->ShowPanel(); ?>
<div id='root'>
    <div class='box'>
        <a href="" id="top"></a>

        <div class='box'>
            <?
            if (SITE_ID == "s1") {
                $img = "logotip2";
            } elseif (SITE_ID == "s2") {
                $img = "logo-eng";
            }
            ?>
            <a href="/mobile/" class="logo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $img ?>.jpg"/>

                <p><?= GetMessage("Republican") ?><br><?= GetMessage("information") ?><br><?= GetMessage("agency") ?>
                </p>
            </a>

            <div class="poisk">
                <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/mobile/search.php" method="get" id="search-block-form">
                    <div class="form-item">
                        <input type="text" name="q" value="" size="15" maxlength="128" placeholder="Поиск по сайту">
                    </div>
                    <div class="form-actions">
                        <input type="submit" id="edit-submit" name="op" value="" class="form-submit">
                    </div>
                    <input type="hidden" name="how" value="r">
                </form>
            </div>
        </div>
        <div class="clear"></div>


        <div class="top">


