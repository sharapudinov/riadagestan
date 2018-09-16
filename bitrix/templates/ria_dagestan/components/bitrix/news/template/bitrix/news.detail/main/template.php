<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//    test_dump($arResult);
function prepare_vr360($file,$width='200%',$height="400px")
{
    $id='vr'.$file;
    if($path = CFile::GetPath($file)) {
        $name = end(explode('/', $path));
        $newpath = $_SERVER['DOCUMENT_ROOT'] . '/vrtest/' . $name;
        if (!file_exists($newpath)) {
            copy($_SERVER['DOCUMENT_ROOT'] . $path, $newpath);
        }
        return '<div id="'.$id.'"></div>
        <script>
          window.addEventListener("load", onVrViewLoad'.$file.');
              function onVrViewLoad'.$file.'() {
                 var vrView'.$file.' = new VRView.Player("#'.$id.'", {
                 image: "https://riadagestan.ru/vrtest/'.$name.'",
                 width:"'.$width.'",
                 height:"'.$height.'",
                 is_stereo: false
              });
          }
        </script>
      ';
    }
}
$this->setFrameMode(true); ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<div class="news_item1">
    <script>
        $(document).ready(function () {
            $('.mvideo iframe').attr({"width": "340", "height": "255"});
            $('.mvideo iframe').attr("src", $('.mvideo iframe').attr("src") + "?wmode=transparent");

        });
    </script>
    <div class="itemHeader">
        <!-- Item title -->
        <h1 class="itemTitle">
            <?= $arResult["NAME"] ?>
        </h1>
        <!-- Date created -->
        <? $mass_date = get_date($arResult["DISPLAY_ACTIVE_FROM"]); ?>
        <span class="itemDateCreated">
						<?= $mass_date["day"] ?> <?= $mass_date["month"] ?> <?= $mass_date["year"] ?> <?= $mass_date["time"] ?>
					</span>
        <!-- Item category -->
        <span class="itemCategory">
						<span><?= GetMessage("posted_in") ?>:&nbsp;&nbsp;</span><a
                href="<? echo($arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"]) ?>"><? echo $arResult["SECTION"]["PATH"][0]["NAME"] ?></a>
            <? if ($arResult["SECTION"]["PATH"][1]["NAME"] != null): ?>
                &nbsp;-&nbsp;<a
                    href="<? echo($arResult["SECTION"]["PATH"][1]["SECTION_PAGE_URL"]) ?>"><? echo $arResult["SECTION"]["PATH"][1]["NAME"] ?></a>
            <? endif; ?>
					</span>
        <?
        if ($arResult["PROPERTIES"]["LINK_SOURCE"]["VALUE"] != "") {
            ?>
            <span class="itemCategory">
						<span><?= GetMessage("source") ?>
                            : &nbsp;</span><?= $arResult["PROPERTIES"]["LINK_SOURCE"]["VALUE"] ?>
					</span>
            <?
        }
        ?>
        <div class="clear"></div>
        <!-- Item Author -->
        <?
        if ($arResult["PROPERTIES"]["author"]["VALUE"] != "" && $arResult['PROPERTIES']['not_view_author']['VALUE'] != 'Y') {
            ?>
            <span class="itemAuthor">
						<?= GetMessage("author1") ?>: &nbsp;<?= $arResult["PROPERTIES"]["author"]["VALUE"] ?>
					</span>
            <?
        }
        ?>
        <?
        if ($arResult["PROPERTIES"]["foto_author"]["VALUE"] != "") {
            ?>
            <span class="itemAuthor">
						<?= GetMessage("foto1") ?>: &nbsp;<?= $arResult["PROPERTIES"]["foto_author"]["VALUE"] ?>
					</span>
            <?
        }
        ?>
        <div style="clear:both;float;none;"></div>
        <div class="vozmozhnosti_wrapper">
            <div class="vozmozhnosti">
                <div class="shrift"><span class="razmer"><?= GetMessage("font_size1") ?></span><span
                        class="minus">-</span><span class="plus">+</span></div>
                <a href="<?= $APPLICATION->GetCurUri("print=Y") ?>" target="_blank"
                   class="pechat"><?= GetMessage("print1") ?></a>
            </div>
        </div>
    </div>
    <?
    if (is_array($arResult["PROPERTIES"]["IMAGES"]["VALUE"]) || $arResult["PROPERTIES"]["VIDEO"]["VALUE"] || $arResult["PROPERTIES"]["VR360"]["VALUE"])
    {
    $imageinfo = getimagesize($_SERVER["DOCUMENT_ROOT"] .
        CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]));
    ?>
    <div class="pikachoose">
        <div class="mimages">
            <? if ($arResult["PROPERTIES"]["VR360"]["VALUE"]){
                header("Access-Control-Allow-Origin: *");
                $vr=prepare_vr360($arResult["PROPERTIES"]["VR360"]["VALUE"]);
                echo  $vr;
            }
            elseif (is_array($arResult["PROPERTIES"]["IMAGES"]["VALUE"])){
            ?>
            <ul class="rslides">
                <? for ($ii = 0; $ii < count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]); $ii++) : ?>
                    <?
                    $result_image_big = CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii]);
                    $result_image_small = "/upload/fotonews/result_image_small" . $arResult["PROPERTIES"]["IMAGES"]["VALUE"][$ii] . ".jpg";
                    $dc_result_image2 = $_SERVER["DOCUMENT_ROOT"] . $result_image_small;

                    if (!file_exists($dc_result_image2)) {
                        CFile::ResizeImageFile(
                            $source = $_SERVER["DOCUMENT_ROOT"] . $result_image_big,
                            $result = $dc_result_image2,
                            array(
                                'width' => 340,
                                'height' => 255
                            ),
                            BX_RESIZE_IMAGE_EXACT,
                            array(
                                "type" => "image",
                                "file" => $_SERVER["DOCUMENT_ROOT"] . "/images/small_water2.png",
                                "size" => "real",
                                "alpha_level" => 100,
                                // 0 - 100
                                "position" => "br"
                                /*                                        "fill" => 'repeat', // resize | repeat)*/
                            )
                        );
                    }
                    ?>
                    <li>
                        <a class="fancybox" href="<?= $result_image_big; ?>" data-fancybox-group="gallery">
                            <img class="preview_picture" border="0" src="<?= $result_image_small; ?>"
                                 width="340" height="255"/>
                        </a>
                    </li>

                <? endfor ?>
            </ul>
            <script>
                $('.fancybox').fancybox({
                    closeBtn: false
                });
                $(".rslides").responsiveSlides();
                $(".rslides").responsiveSlides({
                    auto: true,             // Boolean: Animate automatically, true or false
                    speed: 500,            // Integer: Speed of the transition, in milliseconds
                    timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
                    pager: true,           // Boolean: Show pager, true or false
                    nav: false,             // Boolean: Show navigation, true or false
                    random: false,          // Boolean: Randomize the order of the slides, true or false
                    pause: false,           // Boolean: Pause on hover, true or false
                    pauseControls: true,    // Boolean: Pause when hovering controls, true or false
                    prevText: "",   // String: Text for the "previous" button
                    nextText: "",       // String: Text for the "next" button
                    maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                    navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                    manualControls: "",     // Selector: Declare custom pager navigation
                    namespace: "rslides",   // String: Change the default namespace used
                    before: function () {
                    },   // Function: Before callback
                    after: function () {
                    }     // Function: After callback
                });
            </script>
            <?}?>
        </div>
        <span class="mvideo">
            <?
            if ($arResult["PROPERTIES"]["VIDEO"]["VALUE"]) :


                ?>
                <?= htmlspecialchars_decode(
                str_replace(
                    "ifr ame",
                    "iframe",
                    $arResult["PROPERTIES"]["VIDEO"]["VALUE"]
                )
            ) ?>
            <? endif ?>
    </span>
    </div>
    <?}?>
    <div class="text" id="qaz">
        <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"]): ?>
            <p><?= $arResult["FIELDS"]["PREVIEW_TEXT"];
                unset($arResult["FIELDS"]["PREVIEW_TEXT"]); ?></p>
        <? endif; ?>
        <? if ($arResult["NAV_RESULT"]): ?>
            <? if ($arParams["DISPLAY_TOP_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><br/><? endif; ?>
            <? echo $arResult["NAV_TEXT"]; ?>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><br/><?= $arResult["NAV_STRING"] ?><? endif; ?>
        <? elseif (strlen($arResult["DETAIL_TEXT"]) > 0): ?>
            <?
            if (is_array($arResult["PROPERTIES"]["VR360EMBED"]["VALUE"])){
                foreach ($arResult["PROPERTIES"]["VR360EMBED"]["VALUE"] as $key=>$value){
                    $arResult["DETAIL_TEXT"]=preg_replace("/#$key#/",prepare_vr360($value,'100%','400px'),$arResult["DETAIL_TEXT"]);

                }

            };
            header("Access-Control-Allow-Origin: *");
            echo $arResult["DETAIL_TEXT"];


            ?>
        <? else: ?>
            <? echo $arResult["PREVIEW_TEXT"]; ?>
        <? endif ?>

    </div>
    <br/>

    <div style="clear:both;float;none;"></div>

    <?
    if (SITE_ID == "s1") {
        $share_ver = "ru";
    } elseif (SITE_ID == "s2") {
        $share_ver = "en";
    }
    ?>
<!--    <script type="text/javascript">
        $('.plus').click(function () {
            if ($('div.text').attr('my') != "1") {
                $('.text p').attr({'style': ''})
                var s1 = $('.text').css('font-size');
            }
            else {
                var s1 = $('.text').css('font-size');
            }
            s1 = s1[0] + s1[1];
            var num = parseInt(s1)
            if (num < 30) num += 3
            $('.text p').css('font-size', num + "px");
            $('.text').css('font-size', num + "px");
            $('.text div').css('font-size', num + "px");
            $('div.text').attr('my', "1");
        });

        $('.minus').click(function () {
            if ($('div.text').attr('my') != "1") {
                $('.text p').attr({'style': ''})
            }
            else {
                var s1 = $('.text').css('font-size');
            }
            s1 = s1[0] + s1[1];
            var num = parseInt(s1)
            if (num > 10) num--
            $('.text p').css('font-size', num + "px");
            $('.text').css('font-size', num + "px");
            $('.text div').css('font-size', num + "px");
            $('div.text').attr('my', "1");
        });
    </script>
    <div class="likely likely-small">
        <div class="twitter"></div>
        <div class="facebook"></div>
        <div class="gplus"></div>
        <div class="vkontakte"></div>
        <div class="odnoklassniki"></div>
        <div class="pinterest"
             data-media='<?/*= "https://" . $_SERVER['SERVER_NAME'] . CFile::GetPath($arResult["PROPERTIES"]["IMAGES"]["VALUE"][0]) */?>'></div>
    </div>-->
    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter,whatsapp,telegram"></div>
    <!--test-->
    <script type="text/javascript">
        !function t(e, n, i) {
            function r(c, s) {
                if (!n[c]) {
                    if (!e[c]) {
                        var u = "function" == typeof require && require;
                        if (!s && u)return u(c, !0);
                        if (o)return o(c, !0);
                        throw new Error("Cannot find module '" + c + "'")
                    }
                    var a = n[c] = {exports: {}};
                    e[c][0].call(a.exports, function (t) {
                        var n = e[c][1][t];
                        return r(n ? n : t)
                    }, a, a.exports, t, e, n, i)
                }
                return n[c].exports
            }

            for (var o = "function" == typeof require && require, c = 0; c < i.length; c++)r(i[c]);
            return r
        }({
            1: [function (t, e) {
                function n(t, e, n) {
                    this.widget = t, this.likely = e, this.options = c.merge(n), this.init()
                }

                var i = t("./services"), r = t("./config"), o = t("./fetch"), c = t("./utils"), s = t("./dom"), u = {
                    span: '<span class="{className}">{content}</span>',
                    link: '<a href="{href}"></a>'
                };
                n.prototype = {
                    init: function () {
                        this.detectService(), this.detectParams(), this.initHtml(), setTimeout(this.initCounter.bind(this), 0)
                    }, update: function (t) {
                        var e = "." + r.prefix + "counter";
                        counters = s.findAll(e, this.widget), c.extend(this.options, c.merge({forceUpdate: !1}, t)), c.toArray(counters).forEach(function (t) {
                            t.parentNode.removeChild(t)
                        }), this.initCounter()
                    }, detectService: function () {
                        var t = this.widget, e = c.getDataset(t).service;
                        if (!e) {
                            for (var n = t.className.split(" "), r = 0; r < n.length && !(n[r] in i); r++);
                            e = n[r]
                        }
                        e && (this.service = e, c.extend(this.options, i[e]))
                    }, detectParams: function () {
                        var t = this.options, e = c.getDataset(this.widget);
                        if (e.counter) {
                            var n = parseInt(e.counter, 10);
                            isNaN(n) ? t.counterUrl = e.counter : t.counterNumber = n
                        }
                        t.title = e.title || t.title, t.url = e.url || t.url
                    }, initHtml: function () {
                        var t = this.options, e = this.widget, n = e.innerHTML;
                        t.clickUrl ? this.widget = e = this.createLink(e, t) : e.addEventListener("click", this.click.bind(this)), e.classList.remove(this.service), e.className += " " + this.className("widget");
                        var i = c.template(u.span, {
                            className: this.className("button"),
                            content: n
                        }), r = c.template(u.span, {className: this.className("icon"), content: s.wrapSVG(t.svgi)});
                        e.innerHTML = r + i
                    }, initCounter: function () {
                        var t = this.options;
                        t.counters && t.counterNumber ? this.updateCounter(t.counterNumber) : o(this.service, t.url, t)(this.updateCounter.bind(this))
                    }, className: function (t) {
                        return c.likelyClass(t, this.service)
                    }, updateCounter: function (t) {
                        t = parseInt(t, 10) || 0;
                        var e = s.find(".likely__counter", this.widget);
                        e && e.parentNode.removeChild(e);
                        var n = {className: this.className("counter"), content: t};
                        t || this.options.zeroes || (n.className += " " + r.prefix + "counter_empty", n.content = ""), this.widget.appendChild(s.createNode(c.template(u.span, n))), this.likely.updateCounter(null, this.service, t)
                    }, click: function () {
                        var t = this.options;
                        if (t.click.call(this)) {
                            var e = c.makeUrl(t.popupUrl, {url: t.url, title: t.title});
                            s.openPopup(this.addAdditionalParamsToUrl(e), r.prefix + this.service, t.popupWidth, t.popupHeight)
                        }
                        return !1
                    }, addAdditionalParamsToUrl: function (t) {
                        var e = c.query(c.merge(this.widget.dataset, this.options.data)), n = -1 === t.indexOf("?") ? "?" : "&";
                        return "" === e ? t : t + n + e
                    }
                }, e.exports = n
            }, {"./config": 2, "./dom": 3, "./fetch": 6, "./services": 11, "./utils": 17}], 2: [function (t, e) {
                var n = "https:" === window.location.protocol;
                e.exports = {name: "likely", prefix: "likely__", secure: n, protocol: n ? "https:" : "http:"}
            }, {}], 3: [function (t, e) {
                var n = document.createElement("div"), i = 0, r = e.exports = {
                    wrapSVG: function (t) {
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M' + t + 'z"/></svg>'
                    }, createNode: function (t) {
                        return n.innerHTML = t, n.children[0]
                    }, getScript: function (t) {
                        var e = document.createElement("script"), n = document.head;
                        e.type = "text/javascript", e.src = t, n.appendChild(e), n.removeChild(e)
                    }, getJSON: function (t, e) {
                        var n = encodeURIComponent("random_fun_" + ++i);
                        t = t.replace(/callback=(\?)/, "callback=" + n), window[n] = e, r.getScript(t)
                    }, find: function (t, e) {
                        return e = e || document, e.querySelector(t)
                    }, findAll: function (t, e) {
                        return e = e || document, e.querySelectorAll(t)
                    }, openPopup: function (t, e, n, i) {
                        var r = Math.round(screen.width / 2 - n / 2), o = 0;
                        screen.height > i && (o = Math.round(screen.height / 3 - i / 2));
                        var c = "left=" + r + ",top=" + o + ",width=" + n + ",height=" + i + ",personalbar=0,toolbar=0,scrollbars=1,resizable=1", s = window.open(t, e, c);
                        return s ? (s.focus(), s) : location.href = t
                    }
                }
            }, {}], 4: [function (t, e) {
                e.exports = function (t) {
                    var e = [];
                    return function (n) {
                        var i = typeof n;
                        return "undefined" == i ? t : void("function" == i ? e.push(n) : (t = n, e.forEach(function (t) {
                            t(n)
                        })))
                    }
                }
            }, {}], 5: [function (t) {
                var e = t("./index.js");
                window.addEventListener("load", e.initate)
            }, {"./index.js": 7}], 6: [function (t, e) {
                var n = t("./services"), i = t("./factory"), r = t("./utils"), o = (t("./dom"), {});
                e.exports = function (t, e, c) {
                    o[t] || (o[t] = {});
                    var s = o[t], u = s[e];
                    if (!c.forceUpdate && u)return s[e];
                    u = i();
                    var a = r.makeUrl(c.counterUrl, {url: e});
                    return n[t].counter(a, u, e), s[e] = u
                }
            }, {"./dom": 3, "./factory": 4, "./services": 11, "./utils": 17}], 7: [function (t, e) {
                "use strict";
                var n = t("./widget"), i = t("./config"), r = t("./utils"), o = t("./dom"), c = function (t, e) {
                    e = e || {};
                    var o = t[i.name];
                    return o ? o.update(e) : t[i.name] = new n(t, r.merge({}, c.defaults, e, r.bools(t))), o
                };
                c.initate = function () {
                    var t = o.findAll("." + i.name);
                    r.toArray(t).forEach(c)
                }, c.defaults = {
                    popupCheckInterval: 150,
                    counters: !0,
                    timeout: 1e3,
                    zeroes: !1,
                    title: document.title,
                    wait: 500,
                    url: window.location.href.replace(window.location.hash, "")
                }, e.exports = c
            }, {"./config": 2, "./dom": 3, "./utils": 17, "./widget": 18}], 8: [function (t, e) {
                var n = t("./dom"), i = function (t, e) {
                    var i = this;
                    n.getJSON(t, function (t) {
                        try {
                            "function" == typeof i.convertNumber && (t = i.convertNumber(t)), e(t)
                        } catch (n) {
                        }
                    })
                };
                e.exports = function (t) {
                    return t.counter = t.counter || i, t.click = t.click || function () {
                            return !0
                        }, t
                }
            }, {"./dom": 3}], 9: [function (t, e) {
                e.exports = {
                    counterUrl: "https://graph.facebook.com/fql?q=SELECT+total_count+FROM+link_stat+WHERE+url%3D%22{url}%22&callback=?",
                    convertNumber: function (t) {
                        return t.data[0].total_count
                    },
                    popupUrl: "https://www.facebook.com/sharer/sharer.php?u={url}",
                    popupWidth: 600,
                    popupHeight: 500
                }
            }, {}], 10: [function (t, e) {
                var n = t("../config"), i = t("../utils"), r = t("../dom"), o = {
                    counterUrl: n.secure ? void 0 : "http://share.yandex.ru/gpp.xml?gid={gid}&url={url}",
                    counter: function (t, e, n) {
                        var o = this.gid++;
                        this.promises[o + "_" + n] = e, r.getScript(i.makeUrl(t, {gid: o}))
                    },
                    gid: 0,
                    promises: {},
                    popupUrl: "https://plus.google.com/share?url={url}",
                    popupWidth: 700,
                    popupHeight: 500
                };
                i.set(window, "services.gplus.cb", function (t) {
                    "string" == typeof t && (t = t.replace(/\D/g, ""));
                    var e = i.getStackURL(), n = i.getURL(e), r = e.match(/gid=(\d+)/).pop();
                    o.promises[r + "_" + n](t)
                }), e.exports = o
            }, {"../config": 2, "../dom": 3, "../utils": 17}], 11: [function (t, e) {
                var n = t("../utils"), i = t("../svg.json"), r = t("../service"), o = {
                    odnoklassniki: t("./odnoklassniki"),
                    vkontakte: t("./vk"),
                    pinterest: t("./pinterest"),
                    facebook: t("./facebook"),
                    twitter: t("./twitter"),
                    gplus: t("./gplus")
                };
                n.each(o, function (t, e) {
                    o[e] = r(t), t.svgi = i[e], t.name = e
                }), e.exports = o
            }, {
                "../service": 8,
                "../svg.json": 16,
                "../utils": 17,
                "./facebook": 9,
                "./gplus": 10,
                "./odnoklassniki": 12,
                "./pinterest": 13,
                "./twitter": 14,
                "./vk": 15
            }], 12: [function (t, e) {
                var n = t("../config"), i = t("../utils"), r = t("../dom"), o = {
                    counterUrl: n.secure ? void 0 : "http://connect.ok.ru/dk?st.cmd=extLike&ref={url}&uid={index}",
                    counter: function (t, e) {
                        var n = o;
                        n.promises.push(e), r.getScript(i.makeUrl(t, {index: n.promises.length - 1}))
                    },
                    promises: [],
                    popupUrl: "http://connect.ok.ru/dk?st.cmd=WidgetSharePreview&service=odnoklassniki&st.shareUrl={url}",
                    popupWidth: 640,
                    popupHeight: 400
                };
                i.set(window, "ODKL.updateCount", function (t, e) {
                    o.promises[t](e)
                }), e.exports = o
            }, {"../config": 2, "../dom": 3, "../utils": 17}], 13: [function (t, e) {
                var n = t("../config");
                e.exports = {
                    counterUrl: n.protocol + "//api.pinterest.com/v1/urls/count.json?url={url}&callback=?",
                    convertNumber: function (t) {
                        return t.count
                    },
                    popupUrl: n.protocol + "//pinterest.com/pin/create/button/?url={url}&description={title}",
                    popupWidth: 630,
                    popupHeight: 270
                }
            }, {"../config": 2}], 14: [function (t, e) {
                e.exports = {
                    counterUrl: "https://cdn.api.twitter.com/1/urls/count.json?url={url}&callback=?",
                    convertNumber: function (t) {
                        return t.count
                    },
                    popupUrl: "https://twitter.com/intent/tweet?url={url}&text={title}",
                    popupWidth: 600,
                    popupHeight: 450,
                    click: function () {
                        return /[\.\?:\-–—]\s*$/.test(this.options.title) || (this.options.title += ":"), !0
                    }
                }
            }, {}], 15: [function (t, e) {
                var n = t("../config"), i = t("../utils"), r = t("../dom"), o = {
                    counterUrl: "https://vk.com/share.php?act=count&url={url}&index={index}",
                    counter: function (t, e) {
                        this.promises.push(e), r.getScript(i.makeUrl(t, {index: this.promises.length - 1}))
                    },
                    promises: [],
                    popupUrl: n.protocol + "//vk.com/share.php?url={url}&title={title}",
                    popupWidth: 550,
                    popupHeight: 330
                };
                i.set(window, "VK.Share.count", function (t, e) {
                    o.promises[t](e)
                }), e.exports = o
            }, {"../config": 2, "../dom": 3, "../utils": 17}], 16: [function (t, e) {
                e.exports = {
                    facebook: "13 0H3C1 0 0 1 0 3v10c0 2 1 3 3 3h5V9H6V7h2V5c0-2 2-2 2-2h3v2h-3v2h3l-.5 2H10v7h3c2 0 3-1 3-3V3c0-2-1-3-3-3",
                    twitter: "15.96 3.42c-.04.153-.144.31-.237.414l-.118.058v.118l-.59.532-.237.295c-.05.036-.398.21-.413.237V6.49h-.06v.473h-.058v.294h-.058v.296h-.06v.235h-.06v.237h-.058c-.1.355-.197.71-.295 1.064h-.06v.116h-.06c-.02.1-.04.197-.058.296h-.06c-.04.118-.08.237-.118.355h-.06c-.038.118-.078.236-.117.353l-.118.06-.06.235-.117.06v.116l-.118.06v.12h-.06c-.02.057-.038.117-.058.175l-.118.06v.117c-.06.04-.118.08-.177.118v.118l-.237.177v.118l-.59.53-.532.592h-.117c-.06.078-.118.156-.177.236l-.177.06-.06.117h-.118l-.06.118-.176.06v.058h-.118l-.06.118-.353.12-.06.117c-.078.02-.156.04-.235.058v.06c-.118.038-.236.078-.354.118v.058H8.76v.06h-.12v.06h-.176v.058h-.118v.06H8.17v.058H7.99v.06l-.413.058v.06h-.237c-.667.22-1.455.293-2.36.293h-.886v-.058h-.53v-.06H3.27v-.06h-.295v-.06H2.68v-.057h-.177v-.06h-.236v-.058H2.09v-.06h-.177v-.058h-.177v-.06H1.56v-.058h-.12v-.06l-.294-.06v-.057c-.118-.04-.236-.08-.355-.118v-.06H.674v-.058H.555v-.06H.437v-.058H.32l-.06-.12H.142v-.058c-.13-.08-.083.026-.177-.118H1.56v-.06c.294-.04.59-.077.884-.117v-.06h.177v-.058h.237v-.06h.118v-.06h.177v-.057h.118v-.06h.177v-.058l.236-.06v-.058l.236-.06c.02-.038.04-.078.058-.117l.237-.06c.02-.04.04-.077.058-.117h.118l.06-.118h.118c.036-.025.047-.078.118-.118V12.1c-1.02-.08-1.84-.54-2.303-1.183-.08-.058-.157-.118-.236-.176v-.117l-.118-.06v-.117c-.115-.202-.268-.355-.296-.65.453.004.987.008 1.354-.06v-.06c-.254-.008-.47-.08-.65-.175v-.058H2.32v-.06c-.08-.02-.157-.04-.236-.058l-.06-.118h-.117l-.118-.178h-.12c-.077-.098-.156-.196-.235-.294l-.118-.06v-.117l-.177-.12c-.35-.502-.6-1.15-.59-2.006h.06c.204.234.948.377 1.357.415v-.06c-.257-.118-.676-.54-.827-.768V5.9l-.118-.06c-.04-.117-.08-.236-.118-.354h-.06v-.118H.787c-.04-.196-.08-.394-.118-.59-.06-.19-.206-.697-.118-1.005h.06V3.36h.058v-.177h.06v-.177h.057V2.83h.06c.04-.118.078-.236.117-.355h.118v.06c.12.097.237.196.355.295v.118l.118.058c.08.098.157.197.236.295l.176.06.354.413h.118l.177.236h.118l.06.117h.117c.04.06.08.118.118.177h.118l.06.118.235.06.06.117.356.12.06.117.53.176v.06h.118v.058l.236.06v.06c.118.02.236.04.355.058v.06h.177v.058h.177v.06h.176v.058h.236v.06l.472.057v.06l1.417.18v-.237c-.1-.112-.058-.442-.057-.65 0-.573.15-.99.354-1.358v-.117l.118-.06.06-.235.176-.118v-.118c.14-.118.276-.236.414-.355l.06-.117h.117l.12-.177.235-.06.06-.117h.117v-.058H9.7v-.058h.177v-.06h.177v-.058h.177v-.06h.296v-.058h1.063v.058h.294v.06h.177v.058h.178v.06h.177v.058h.118v.06h.118l.06.117c.08.018.158.038.236.058.04.06.08.118.118.177h.118l.06.117c.142.133.193.163.472.178.136-.12.283-.05.472-.118v-.06h.177v-.058h.177v-.06l.236-.058v-.06h.177l.59-.352v.176h-.058l-.06.295h-.058v.117h-.06v.118l-.117.06v.118l-.177.118v.117l-.118.06-.354.412h-.117l-.177.236h.06c.13-.112.402-.053.59-.117l1.063-.353",
                    vkontakte: "13 0H3C1 0 0 1 0 3v10c0 2 1 3 3 3h10c2 0 3-1 3-3V3c0-2-1-3-3-3zm.452 11.394l-1.603.022s-.345.068-.8-.243c-.598-.41-1.164-1.48-1.604-1.342-.446.144-.432 1.106-.432 1.106s.003.206-.1.315c-.11.12-.326.144-.326.144H7.87s-1.582.095-2.975-1.356c-1.52-1.583-2.862-4.723-2.862-4.723s-.078-.206.006-.305c.094-.112.35-.12.35-.12l1.716-.01s.162.026.277.11c.095.07.15.202.15.202s.276.7.643 1.335c.716 1.238 1.05 1.508 1.293 1.376.353-.193.247-1.75.247-1.75s.006-.565-.178-.817c-.145-.194-.415-.25-.534-.267-.096-.014.062-.238.267-.338.31-.15.853-.16 1.497-.153.502.004.646.035.842.083.59.143.39.694.39 2.016 0 .422-.075 1.018.23 1.215.13.085.453.013 1.256-1.352.38-.647.666-1.407.666-1.407s.062-.136.16-.194c.098-.06.232-.04.232-.04l1.804-.012s.542-.065.63.18c.092.257-.203.857-.94 1.84-1.21 1.612-1.345 1.46-.34 2.394.96.89 1.16 1.325 1.192 1.38.4.66-.44.71-.44.71",
                    gplus: "8,6.5v3h4.291c-0.526,2.01-2.093,3.476-4.315,3.476C5.228,12.976,3,10.748,3,8c0-2.748,2.228-4.976,4.976-4.976c1.442,0,2.606,0.623,3.397,1.603L13.52,2.48C12.192,0.955,10.276,0,8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s7.5-3.582,7.5-8V6.5H8",
                    pinterest: "7.99 0c-4.417 0-8 3.582-8 8 0 3.39 2.11 6.284 5.086 7.45-.07-.633-.133-1.604.028-2.295.145-.624.938-3.977.938-3.977s-.24-.48-.24-1.188c0-1.112.645-1.943 1.448-1.943.683 0 1.012.512 1.012 1.127 0 .686-.437 1.713-.663 2.664-.19.796.398 1.446 1.184 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.255-3.343-3.255-2.276 0-3.612 1.707-3.612 3.472 0 .688.265 1.425.595 1.826.065.08.075.15.055.23-.06.252-.195.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.835-4.84 5.287-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.74 4.976-4.152 4.976-.81 0-1.573-.42-1.834-.92l-.498 1.903c-.18.695-.668 1.566-.994 2.097.75.232 1.544.357 2.37.357 4.417 0 8-3.582 8-8s-3.583-8-8-8",
                    odnoklassniki: "8 6.107c.888 0 1.607-.72 1.607-1.607 0-.888-.72-1.607-1.607-1.607s-1.607.72-1.607 1.607c0 .888.72 1.607 1.607 1.607zM13 0H3C1 0 0 1 0 3v10c0 2 1 3 3 3h10c2 0 3-1 3-3V3c0-2-1-3-3-3zM8 .75c2.07 0 3.75 1.68 3.75 3.75 0 2.07-1.68 3.75-3.75 3.75S4.25 6.57 4.25 4.5C4.25 2.43 5.93.75 8 .75zm3.826 12.634c.42.42.42 1.097 0 1.515-.21.208-.483.313-.758.313-.274 0-.548-.105-.758-.314L8 12.59 5.69 14.9c-.42.418-1.098.418-1.516 0s-.42-1.098 0-1.516L6.357 11.2c-1.303-.386-2.288-1.073-2.337-1.11-.473-.354-.57-1.025-.214-1.5.354-.47 1.022-.567 1.496-.216.03.022 1.4.946 2.698.946 1.31 0 2.682-.934 2.693-.943.474-.355 1.146-.258 1.5.213.355.474.26 1.146-.214 1.5-.05.036-1.035.723-2.338 1.11l2.184 2.184"
                }
            }, {}], 17: [function (t, e) {
                var n = t("./config"), i = {
                    yes: !0,
                    no: !1
                }, r = /(https?|ftp):\/\/[^\s\/$.?#].[^\s]*/gi, o = {
                    each: function (t, e) {
                        for (var n in t)t.hasOwnProperty(n) && e(t[n], n)
                    }, toArray: function (t) {
                        return Array.prototype.slice.call(t)
                    }, merge: function () {
                        for (var t = {}, e = 0; e < arguments.length; e++) {
                            var n = arguments[e];
                            if (n)for (var i in n)t[i] = n[i]
                        }
                        return t
                    }, extend: function (t, e) {
                        for (var n in e)t[n] = e[n]
                    }, getDataset: function (t) {
                        if ("object" == typeof t.dataset)return t.dataset;
                        var e, n, i, r = {}, o = t.attributes, c = function (t) {
                            return t.charAt(1).toUpperCase()
                        };
                        for (e = o.length - 1; e >= 0; e--)n = o[e], n && n.name && /^data-\w[\w\-]*$/.test(n.name) && (i = n.name.substr(5).replace(/-./g, c), r[i] = n.value);
                        return r
                    }, bools: function (t) {
                        var e = {}, n = o.getDataset(t);
                        for (var r in n) {
                            var c = n[r];
                            e[r] = i[c] || c
                        }
                        return e
                    }, template: function (t, e) {
                        return t ? t.replace(/\{([^\}]+)\}/g, function (t, n) {
                            return n in e ? e[n] : t
                        }) : ""
                    }, makeUrl: function (t, e) {
                        for (var n in e)e[n] = encodeURIComponent(e[n]);
                        return o.template(t, e)
                    }, likelyClass: function (t, e) {
                        var i = n.prefix + t;
                        return i + " " + i + "_" + e
                    }, query: function (t) {
                        var e = encodeURIComponent, n = [];
                        for (var i in t)"object" != typeof t[i] && n.push(e(i) + "=" + e(t[i]));
                        return n.join("&")
                    }, getStackURL: function () {
                        try {
                            throw new Error
                        } catch (t) {
                            return t.stack.match(r).pop().replace(/:\d+:\d+\)?$/, "")
                        }
                    }, getURL: function (t) {
                        return decodeURIComponent(t.match(/url=([^&]+)/).pop())
                    }, set: function (t, e, n) {
                        var i = e.split("."), r = null;
                        i.forEach(function (e, n) {
                            "undefined" == typeof t[e] && (t[e] = {}), n !== i.length - 1 && (t = t[e]), r = e
                        }), t[r] = n
                    }, get: function (t, e) {
                        for (var n = e.split("."), i = 0; i < n.length; i++) {
                            var e = n[i];
                            if (!e in t) {
                                t = null;
                                break
                            }
                            t = t[e]
                        }
                        return t
                    }
                };
                e.exports = o
            }, {"./config": 2}], 18: [function (t, e) {
                function n(t, e) {
                    this.container = t, this.options = e, this.init()
                }

                var i = t("./button"), r = (t("./services"), t("./config")), o = t("./utils");
                n.prototype = {
                    init: function () {
                        this.countersLeft = 0, this.buttons = [], this.number = 0, o.toArray(this.container.children).forEach(this.addButton.bind(this)), this.options.counters ? (this.timer = setTimeout(this.appear.bind(this), this.options.wait), this.timeout = setTimeout(this.ready.bind(this), this.options.timeout)) : this.appear()
                    }, addButton: function (t) {
                        var e = new i(t, this, this.options);
                        this.buttons.push(e), e.options.counterUrl && this.countersLeft++
                    }, update: function (t) {
                        (t.forceUpdate || t.url !== this.options.url) && (this.countersLeft = this.buttons.length, this.number = 0, this.buttons.forEach(function (e) {
                            e.update(t)
                        }))
                    }, updateCounter: function (t, e, n) {
                        n && (this.number += n), this.countersLeft--, 0 === this.countersLeft && (this.appear(), this.ready())
                    }, appear: function () {
                        this.container.classList.add(r.name + "_visible")
                    }, ready: function () {
                        this.timeout && (clearTimeout(this.timeout), this.container.classList.add(r.name + "_ready"))
                    }
                }, e.exports = n
            }, {"./button": 1, "./config": 2, "./services": 11, "./utils": 17}]
        }, {}, [5]);
    </script>
    <!--<script type="text/javascript" src="//yandex.st/share/share.js"
            charset="utf-8"></script>
    <div class="yashare-auto-init" data-yashareL10n="<? /*= $share_ver */ ?>"
         data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,lj,gplus"
        ></div>-->
    <? if ($arResult['PROPERTIES']['location']['VALUE']) {
        $location = explode(
            ',',
            $arResult["PROPERTIES"]["location"]["VALUE"]
        );
        $lon = $location[1];
        $lat = $location[0]; ?>
        <? $MAP_DATA = Array
        (
            "yandex_lat" => $lat,
            "yandex_lon" => $lon,
            "yandex_scale" => "16",
            "PLACEMARKS" => Array
            (
                "0" => Array
                (
                    "TEXT" => "Место события",
                    "LON" => $lon,
                    "LAT" => $lat,
                )

            ),
        );

        $mapType_el = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_CODE" => "maps",
                "ID" => 52146
            ),
            false,
            false,
            array(
                "IBLOCK_ID",
                "ID",
                "PROPERTY_map_type"
            )
        )->GetNext();
        $mapType = $mapType_el['PROPERTY_MAP_TYPE_ENUM_ID'];
        $arMapTypes = array(
            70 => "MAP",
            71 => "SATELLITE",
            72 => "HYBRID",
            73 => "PUBLIC",
            74 => "PUBLIC_HYBRID"
        );
        $APPLICATION->IncludeComponent(
            "bitrix:map.yandex.view",
            ".default",
            Array(
                "YANDEX_VERSION" => '2.0-stable',
                "INIT_MAP_TYPE" => $arMapTypes[$mapType],
                "MAP_DATA" => serialize($MAP_DATA),
                "MAP_WIDTH" => "680",
                "MAP_HEIGHT" => "510",
                "CONTROLS" => array(
                    "TOOLBAR",
                    "ZOOM",
                    "SMALLZOOM",
                    "TYPECONTROL",
                    "SCALELINE"
                ),
                "OPTIONS" => array(
                    "ENABLE_SCROLL_ZOOM",
                    "ENABLE_DBLCLICK_ZOOM",
                    "ENABLE_DRAGGING"
                ),
                "MAP_ID" => "yam_1",
                "DEV_MODE" => 'N'
            ),
            $component
        );
    } ?>
    <br>
    <br>
    <b style="color: #2e699e;font-size: 14px">Больше важных и актуальных  новостей в
        <a target="_blank" href="https://t.me/riadagestan"> Telegram-канале РИА «ДАГЕСТАН».</a>
        Подписывайся!
        </b>
    <br/>
    <!--BEGIN показ посещений-->
    <? if ($arResult["PROPERTIES"]["on_of_views"]["VALUE"] == 1): ?>

        <div class="itemContentFooter">
			<span class="itemHits">
            <?= GetMessage("totalviews") ?>:
            <b>
                <? $frame = $this->createFrame()->begin('1'); ?>
                <?= $arResult["SHOW_COUNTER"]; ?>
                <? $frame->end(); ?>
             </b>

			</span>
        </div>
        </br>
    <? endif; ?>
    <!--END показ посещений-->

    <?
    if ($arResult['TAGS'] != null) {
        ?>
        <div class="itemTags">
            <?= GetMessage("tags") ?>:
            <?
            $mass_tags = explode(
                ",",
                $arResult['TAGS']
            );
            foreach ($mass_tags as $key => $ch) {
                ?>
                <a href="/search/tags/?tags=<?= $ch ?>"><?= $ch . ($key + 1 != count(
                        $mass_tags
                    ) ? ', ' : '') ?></a>
                <?
            } ?>
        </div>
        <?
    }
    ?>

    <div class="itemTagsBlock">
        <span class="tegi"></span>
        <ul class="itemTags">
            <? if (isset($arResult["DISPLAY_PROPERT IES"]["THEME"])): ?>
                <li>
                    <?= GetMessage("themes") ?>:&nbsp;
                    <? if (is_array($arResult["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"])): ?>
                        <?= implode(
                            ",&nbsp;",
                            $arResult["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"]
                        ); ?>
                    <? else: ?>
                        <?= $arResult["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"]; ?>
                    <? endif ?>
                </li>
            <? endif ?>
        </ul>
        <div style="clear:both;float:none;"></div>
    </div>
    <h2 class="other"><?= GetMessage("other_news") ?>:</h2>


    <? $arThemes = $arResult['PROPERTIES']['THEME']['VALUE'];

    if (is_array($arThemes))
        $GLOBALS["arrFilterTheme"] = array(
            "PROPERTY_THEME" => $arThemes,
            "!ID" => $arResult["ID"]
        );
    elseif (CModule::IncludeModule('iblock')) {
        $dbSection = CIBlockElement::GetElementGroups(
            $arResult['ID'],
            true,
            array("ID")
        );
        $arSection = $dbSection->getNext();
        $GLOBALS["arrFilterTheme"] = array(
            "SECTION_ID" => $arSection["ID"],
            "!ID" => $arResult["ID"]
        );
    }

    ?>
    <?
    if (SITE_ID == 's1') {
        $iblock_id = 2;
        $iblock_type = "news";
    }
    if (SITE_ID == 's2') {
        $iblock_id = '16';
        $iblock_type = "news_en";
    }

    $component->arResult["LIST_SUB_NEWS"] = $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "main_theme_news",
        array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => "N",
            "IBLOCK_TYPE" => $iblock_type,
            "IBLOCK_ID" => $iblock_id,
            "NEWS_COUNT" => "30",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "SORT",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrFilterTheme",
            "FIELD_CODE" => "",
            "PROPERTY_CODE" => "",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Страница",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_TEMPLATE" => "",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y",
            "AJAX_OPTION_SHADOW" => "Y",
            "AJAX_OPTION_JUMP" => "Y",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "Y"
        ),
        $component,
        array(
            "ACTIVE_COMPONENT" => "Y"
        )
    ); ?>

    <? if (is_array($arRefs = $arResult['PROPERTIES']['refs']['~VALUE'])): ?>
        <h2 class="other">Ссылки по теме:</h2>
        <table>
            <? foreach ($arResult['PROPERTIES']['refs']['~VALUE'] as $ref): ?>
                <tr class="theme-ref">
                    <td><?= $ref['TEXT'] ?></td>
                </tr>
            <? endforeach ?>
        </table>
    <? endif ?>

</div>

