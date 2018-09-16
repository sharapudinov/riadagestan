<? IncludeTemplateLangFile(__FILE__); ?>
<? $curDir = $APPLICATION->GetCurDIR();
?>
<? if (!($curDir == '/' || (str_replace('/fotoreportagh/', '', $curDir) != $curDir && strlen($curDir) > 15) || (str_replace('/about/', '', $curDir) != $curDir) || (str_replace('/search/tags/', '', $curDir) != $curDir))): ?>
    <? if (SITE_ID == s1): ?>
        <div class="right_news_spisok">
            <noindex>
            <div class="banner_zona" style="float:left; /* max-height:200px;*/">
                <div class="banner_top" style="float:left; margin-bottom:10px;">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "LEFT1",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>

                </div>
                <div class="russia_for_all">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "GL261x215",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "COMPONENT_TEMPLATE" => ".default",
                            "QUANTITY" => "1"
                        ),
                        false
                    ); ?></div>
                <div class="banner_top" style="float:left; margin-bottom:10px;">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "GLR1264x84",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>

                </div>
            </noindex>
            </div>

            <? global $arFilterMainVideo;
            $arFilterMainVideo = array(
                "IBLOCK_ID" => 13,
                "PROPERTY_main_video_VALUE" => '1');


            $APPLICATION->IncludeComponent("bitrix:news.list", "video", array(
                "IBLOCK_TYPE" => "news",
                "IBLOCK_ID" => "13",
                "NEWS_COUNT" => "1",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "arFilterMainVideo",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "video_iframe",
                    1 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_IMG_WIDTH" => "136",
                "DISPLAY_IMG_HEIGHT" => "101",
                "USE_RSS" => "Y",
                "TITLE_RSS" => "Главные новости информационного портала",
                "AJAX_OPTION_ADDITIONAL" => ""
            ),
                false
            ); ?>


            <div class="rightfotoreportag">
                <? $APPLICATION->IncludeComponent("bitrix:news.list", "fotoreportagh-right", array(
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "11",
                    "NEWS_COUNT" => "1",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "j F Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_IMG_WIDTH" => "235",
                    "DISPLAY_IMG_HEIGHT" => "150",
                    "USE_RSS" => "Y",
                    "TITLE_RSS" => "Главные новости информационного портала",
                    "AJAX_OPTION_ADDITIONAL" => ""
                ),
                    false
                ); ?>


            </div>

            <div class="banner_zona">
                <noindex>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "president",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?></div>


                <div class="banner_bottom">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "nsrd",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "pravitelstvord",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "mingosim",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "press",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600000"
                        ),
                        false
                    ); ?>
                </div>
                <!--<div class="banner_bottom">
                    <? /* $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "socie_nadzor",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); */ ?>
                </div>-->
                <!--<div class="banner_bottom">
                    <?/* $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "prior",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); */?>
                </div>-->

                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "mir",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        ),
                        false
                    ); ?>
                </div>

                <!--<div class="banner_bottom">
                    <?/* $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "prometheus",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        )
                    ); */?>
                </div>-->
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        ".default",
                        array(
                            "TYPE" => "kavpolcentr",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        ),
                        false
                    ); ?>
                </div>
                <!--<div class="banner_bottom">
                    <? /* $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "forum",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000000000",
                            "CACHE_NOTES" => ""
                        )
                    ); */ ?>
                </div>-->
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "zamir",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        )
                    ); ?>
                </div>
                </noindex>
            </div>
        </div>
    <? elseif (SITE_ID == s2): ?>
        <div class="right_news_spisok">
            <div class="banner_zona" style="float:left; margin:0px 0px 10px 0px; height:200px;">
                <div class="banner_top" style="float:left; margin-bottom:10px;">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "LEFT1_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_top">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "right1_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
            </div>

            <? $APPLICATION->IncludeComponent("bitrix:news.list", "video", array(
                "IBLOCK_TYPE" => "news_en",
                "IBLOCK_ID" => "18",
                "NEWS_COUNT" => "1",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "video_iframe",
                    1 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_IMG_WIDTH" => "136",
                "DISPLAY_IMG_HEIGHT" => "101",
                "USE_RSS" => "Y",
                "TITLE_RSS" => "Главные новости информационного портала",
                "AJAX_OPTION_ADDITIONAL" => ""
            ),
                false
            ); ?>

            <div class="rightfotoreportag">
                <? $APPLICATION->IncludeComponent("bitrix:news.list", "fotoreportagh", array(
                    "IBLOCK_TYPE" => "news_en",
                    "IBLOCK_ID" => "19",
                    "NEWS_COUNT" => "1",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "j F Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_IMG_WIDTH" => "235",
                    "DISPLAY_IMG_HEIGHT" => "150",
                    "USE_RSS" => "Y",
                    "TITLE_RSS" => "Главные новости информационного портала",
                    "AJAX_OPTION_ADDITIONAL" => ""
                ),
                    false
                ); ?>

                <!--  AdRiver code START
            <script language="javascript" type="text/javascript">
                (function(){
                    var rnd = Math.round(Math.random() * 1000000000),
                        tail = escape(document.referrer) || 'unknown';
                    document.write(
                    '<iframe src="http://pano.ria.ru/adriver/rus4all_na_riadagestan.html?rnd=' + rnd + '&tail256=' + tail
                    + '" frameborder=0 vspace=0 hspace=0 width=280 height=260 marginwidth=0'
                    + ' marginheight=0 scrolling=no></iframe>');
                })();
            </script>
             AdRiver code END  -->
            </div>


            <div class="banner_zona" style="float:left; margin-top:10px;">
                <div class="banner_top">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "LEFT2_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        )
                    ); ?> </div>
                <div class="banner_top">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "right2_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?></a></div>

                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "president_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_NOTES" => ""
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "nsrd_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "pravitelstvord_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "gos_banner1_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
                <div class="banner_bottom">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:advertising.banner",
                        "",
                        Array(
                            "TYPE" => "gos_banner2_EN",
                            "NOINDEX" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000"
                        )
                    ); ?>
                </div>
            </div>


        </div>
    <? endif ?>
<? endif ?>

</div><!--end class main-->

<footer>
    <? $APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
        "ROOT_MENU_TYPE" => "bottom",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "bottom",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
        false
    ); ?>
    <div class="footer_edit">
        <? $APPLICATION->IncludeFile(
            SITE_DIR . "footer/footer.php",
            array(),
            array("MODE" => "html")
        );
        if (SITE_ID == "s1") {
            $domen_ver = ".com";
        } elseif (SITE_ID == "s2") {
            $domen_ver = ".ru";
        }
        ?>
    </div>
    <p class="copyright"><span>© 2013</span><a href="/about/license/"><?= GetMessage("footer_title") ?></a> <br> <span
            class="bitrix"><a href="/mobile<? $APPLICATION->GetCurPage() ?>"
                              onclick="$.cookie('mobile','Y',{expires:365,path:'/'})"><?= GetMessage("mobile_version") ?></a></span><span
            class="bitrix"><noindex><a rel="nofollow" href="https://riadagestan<?= $domen_ver; ?>"><?= GetMessage("version") ?></a></noindex></span></p>
    <br/>

    <noindex>
        <div class="e_metrika" style="margin-left: 21px; margin-top: -7px;">

        <? if (SITE_ID == 's1'): ?>

            <!-- Yandex.Metrika informer -->
            <a rel="nofollow" href="https://metrika.yandex.ru/stat/?id=21773983&amp;from=informer"
               target="_blank" rel="nofollow"><img
                    src="//bs.yandex.ru/informer/21773983/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
                    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                    title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                    onclick="try{Ya.Metrika.informer({i:this,id:21773983,lang:'ru'});return false}catch(e){}"/></a>
            <!-- /Yandex.Metrika informer -->

            <!--LiveInternet counter-->
            <script type="text/javascript"><!--
                document.write("<a rel='nofollow' href='https://www.liveinternet.ru/click' " +
                    "target=_blank><img src='//counter.yadro.ru/hit?t21.10;r" +
                    escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
                    ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                        screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                    ";" + Math.random() +
                    "' alt='' title='LiveInternet: показано число просмотров за 24" +
                    " часа, посетителей за 24 часа и за сегодня' " +
                    "border='0' width='88' height='31'><\/a>")
                //--></script>
            <!--/LiveInternet-->
            <!-- begin of Top100 code -->
            <script id="top100Counter" type="text/javascript"
                    src="https://counter.rambler.ru/top100.jcn?3123217"></script>
            <noscript>
                <a rel="nofollow" href="https://top100.rambler.ru/navi/3123217/">
                    <img src="https://counter.rambler.ru/top100.cnt?3123217" alt="Rambler's Top100" border="0"/>
                </a>

            </noscript>
            <!-- end of Top100 code -->
             <!-- Rating@Mail.ru counter -->
            <script type="text/javascript">
                var _tmr = _tmr || [];
                _tmr.push({id: "877812", type: "pageView", start: (new Date()).getTime()});
                (function (d, w, id) {
                    if (d.getElementById(id)) return;
                    var ts = d.createElement("script");
                    ts.type = "text/javascript";
                    ts.async = true;
                    ts.id = id;
                    ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
                    var f = function () {
                        var s = d.getElementsByTagName("script")[0];
                        s.parentNode.insertBefore(ts, s);
                    };
                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "topmailru-code");
            </script>
            <noscript>
                <div style="position:absolute;left:-10000px;">
                    <img src="//top-fwz1.mail.ru/counter?id=877812;js=na" style="border:0;" height="1" width="1"
                         alt="Рейтинг@Mail.ru"/>
                </div>
            </noscript>
            <!-- //Rating@Mail.ru counter -->


            <!-- Rating@Mail.ru logo -->
            <a rel="nofollow" href="https://top.mail.ru/jump?from=877812">
                <img src="//top-fwz1.mail.ru/counter?id=877812;t=433;l=1"
                     style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru"/></a>
            <!-- //Rating@Mail.ru logo -->


            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function () {
                        try {
                            w.yaCounter21773983 = new Ya.Metrika({
                                id: 21773983,
                                webvisor: true,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true
                            });
                        } catch (e) {
                        }
                    });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () {
                            n.parentNode.insertBefore(s, n);
                        };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript>
                <div><img src="//mc.yandex.ru/watch/21773983" style="position:absolute; left:-9999px;" alt=""/></div>
            </noscript>
            <!-- /Yandex.Metrika counter -->

            <!--cy-pr.com-->
            <a rel="nofollow" href="https://www.cy-pr.com/" target="_blank">
                <img src="https://www.cy-pr.com/e/riadagestan.ru_1_107.138.206.gif" border="0" width="88" height="31"
                     alt="Проверка тиц"/>
            </a>
            <!--cy-pr.com-->
            <!-- HotLog -->
            <span id="hotlog_counter"></span>
            <span id="hotlog_dyn"></span>
            <script type="text/javascript">
                var hot_s = document.createElement('script');
                hot_s.type = 'text/javascript';
                hot_s.async = true;
                hot_s.src = 'https://js.hotlog.ru/dcounter/2477992.js';
                hot_d = document.getElementById('hotlog_dyn');
                hot_d.appendChild(hot_s);
            </script>
            <noscript>
                <a rel="nofollow" href="https://click.hotlog.ru/?2477992" target="_blank"><img
                        src="https://hit24.hotlog.ru/cgi-bin/hotlog/count?s=2477992&amp;im=303" border="0"
                        alt="HotLog"></a>
            </noscript>
            <!-- /HotLog -->

            <script type="text/javascript" src="/orphus.js"></script>
            <a rel="nofollow" href="https://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="/orphus.gif"
                                                                        border="0"
                                                                        width="150" height="31"/></a>
        <? else: ?>
            <!-- Yandex.Metrika informer -->
            <a rel="nofollow" href="https://metrika.yandex.ru/stat/?id=29287160&amp;from=informer"
               target="_blank" rel="nofollow"><img
                    src="//bs.yandex.ru/informer/29287160/3_1_FFFFFFFF_FFFFFFFF_0_pageviews"
                    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                    title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                    onclick="try{Ya.Metrika.informer({i:this,id:29287160,lang:'ru'});return false}catch(e){}"/></a>
            <!-- /Yandex.Metrika informer -->


            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function () {
                        try {
                            w.yaCounter29287160 = new Ya.Metrika({
                                id: 29287160,
                                webvisor: true,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true
                            });
                        } catch (e) {
                        }
                    });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () {
                            n.parentNode.insertBefore(s, n);
                        };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript>
                <div><img src="//mc.yandex.ru/watch/29287160" style="position:absolute; left:-9999px;" alt=""/></div>
            </noscript>
            <!-- /Yandex.Metrika counter -->
            <!--LiveInternet counter-->
            <script type="text/javascript"><!--
                document.write("<a href='//www.liveinternet.ru/click' " +
                    "target=_blank><img src='//counter.yadro.ru/hit?t11.10;r" +
                    escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
                    ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                        screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                    ";" + Math.random() +
                    "' alt='' title='LiveInternet: показано число просмотров за 24" +
                    " часа, посетителей за 24 часа и за сегодня' " +
                    "border='0' width='88' height='31'><\/a>")
                //--></script><!--/LiveInternet-->
        <? endif ?>
    </div>
    <script type="text/javascript">
        (function(d, t, p) {
            var j = d.createElement(t); j.async = true; j.type = "text/javascript";
            j.src = ("https:" == p ? "https:" : "http:") + "//stat.sputnik.ru/cnt.js";;
            var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
        })(document, "script", document.location.protocol);
    </script>
    <span id="bx-composite-banner"></span>
    </noindex>
</footer>
<!--Google Analitics-->
<? if (SITE_ID == 's1'): ?>
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
<? else: ?>
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

        ga('create', 'UA-44078576-2', 'auto');
        ga('send', 'pageview');

    </script>
<? endif ?>
<!--  /Google-->

</div><!--end class all-->
<style>
    .right_news_spisok .ria_video {
        height: 240px;
    }

    .fixed_right {
        top: 70px;
        position: fixed;
        z-index: 100;
    }

    .main {
        position: relative;
    }
</style>

<?

$APPLICATION->IncludeComponent("bitrix:furniture.catalog.index", "riadag_bg", Array(
        "IBLOCK_TYPE" => "bg",
        "IBLOCK_ID" => "22",
        "IBLOCK_BINDING" => "element",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000",
        "CACHE_GROUPS" => "Y"
    )
);
?>


<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/script.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var scrollObj = new _scroll();
        scrollObj.defineScrollable();
        $(window).on('scroll', function () {
            scrollObj.scrollMenu();
            scrollObj.scrollContent();

            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });

    });
</script>

<a href="#" class="scrollup">Наверх</a>
</body>

</html>
<style>
    #bx-composite-banner {
        opacity: 0 !important;
    }
</style>