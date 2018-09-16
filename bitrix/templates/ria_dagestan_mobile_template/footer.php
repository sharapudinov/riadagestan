<? IncludeTemplateLangFile(__FILE__); ?>
<div class="bottom">
    <? $APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        "",
        Array(
            "TYPE" => "LEFT1",
            "NOINDEX" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_NOTES" => ""
        )
    ); ?>
    <div style="height: 20px"></div>
    <? $APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        ".default",
        array(
            "TYPE" => "GL261x215",
            "NOINDEX" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_NOTES" => ""
        ),
        false
    ); ?>
    <div style="height: 20px"></div>

</div>

<div class="box">
    <div class="soc-seti">
        <a href="https://www.facebook.com/riadagestan?sk=wall" target="_blank">
            <div class="facebook"></div>
        </a>
        <a href="https://twitter.com/riadagestan" target="_blank">
            <div class="twitter"></div>
        </a>
        <a href="https://vkontakte.ru/riadagestan" target="_blank">
            <div class="vk"></div>
        </a>
        <a href="https://www.odnoklassniki.ru/riadagestan" target="_blank">
            <div class="ok"></div>
        </a>
        <a href="https://plus.google.com/" target="_blank">
            <div class="google"></div>
        </a>
        <a href="https://my.mail.ru/mail/riadagestan/" target="_blank">
            <div class="mail-soc"></div>
        </a>
        <a href="https://www.youtube.com/user/riadagestan" target="_blank">
            <div class="youtube"></div>
        </a>
        <a href="https://riadagestan.ru/rss.php" target="_blank">
            <div class="mrss"></div>
        </a>
    </div>
</div>


<div class="box">
    <a href="#top" class="top_button"><?= GetMessage("up") ?></a>
    <?
    $curPage = $APPLICATION->GetCurPage();
    $nonMob = str_replace('/mobile', '', $curPage);
    ?>
    <a href="<?= $nonMob ?>" onclick="$.cookie('mobile','N',{expires:365,path:'/'});"
       class="full_version full_bottom"><?= GetMessage("version") ?></a>

</div>


<div class="box">
    <div class="e_metrica">
        <div>
            <!--LiveInternet counter-->
            <script type="text/javascript"><!--
                document.write("<a href='https://www.liveinternet.ru/click' " +
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
        </div>
        <div>
            <!-- Yandex.Metrika informer -->
            <a href="https://metrika.yandex.ru/stat/?id=21773983&amp;from=informer"
               target="_blank" rel="nofollow"><img
                    src="//bs.yandex.ru/informer/21773983/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
                    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                    title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                    onclick="try{Ya.Metrika.informer({i:this,id:21773983,lang:'ru'});return false}catch(e){}"/></a>
            <!-- /Yandex.Metrika informer -->


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

        </div>
        <div>     <!-- begin of Top100 code -->

            <script id="top100Counter" type="text/javascript"
                    src="https://counter.rambler.ru/top100.jcn?3123217"></script>
            <noscript>
                <a href="https://top100.rambler.ru/navi/3123217/">
                    <img src="https://counter.rambler.ru/top100.cnt?3123217" alt="Rambler's Top100" border="0"/>
                </a>

            </noscript>
            <!-- end of Top100 code -->

        </div>
        <div>
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
                    <img src="https://top-fwz1.mail.ru/counter?id=877812;js=na" style="border:0;" height="1" width="1"
                         alt="Рейтинг@Mail.ru"/>
                </div>
            </noscript>
            <!-- //Rating@Mail.ru counter -->


            <!-- Rating@Mail.ru logo -->
            <a href="https://top.mail.ru/jump?from=877812">
                <img src="https://top-fwz1.mail.ru/counter?id=877812;t=433;l=1"
                     style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru"/></a>
            <!-- //Rating@Mail.ru logo -->
        </div>
        <div>
            <!-- HotLog -->
            <span id="hotlog_counter"></span>
            <span id="hotlog_dyn" ></span>
            <script type="text/javascript">
                var hot_s = document.createElement('script');
                hot_s.type = 'text/javascript';
                hot_s.async = true;
                hot_s.src = 'https://js.hotlog.ru/dcounter/2477992.js';
                hot_d = document.getElementById('hotlog_dyn');
                hot_d.appendChild(hot_s);
            </script>
            <noscript>
                <a href="https://click.hotlog.ru/?2477992" target="_blank"><img
                        src="https://hit24.hotlog.ru/cgi-bin/hotlog/count?s=2477992&amp;im=303" border="0"
                        alt="HotLog"></a>
            </noscript>
            <!-- /HotLog -->
        </div>
        <script type="text/javascript">
            (function(d, t, p) {
                var j = d.createElement(t); j.async = true; j.type = "text/javascript";
                j.src = ("https:" == p ? "https:" : "http:") + "//stat.sputnik.ru/cnt.js";;
                var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
            })(document, "script", document.location.protocol);
        </script>

    </div>

    <p class="copyright">
        <span style="display: none" id="bx-composite-banner"></span>
    </p>
</div>
</div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter27978255 = new Ya.Metrika({
                    id:27978255,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>

</body>
</html>
<style>
    #bx-composite-banner {
        opacity: 0 !important;
    }
</style>