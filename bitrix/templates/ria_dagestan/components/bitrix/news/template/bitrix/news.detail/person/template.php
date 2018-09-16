<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    //test_dump($arResult);
    $this->setFrameMode(true); ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<div class="news_item1">
    <div class="itemHeader">
        <!-- Item title -->
        <h1 class="itemTitle">
            <?= $arResult["NAME"] ?>
        </h1>
        <!-- Item category -->
        <span class="itemCategory">
            <?= $arResult['PREVIEW_TEXT'] ?>
        </span>

        <div class="clear"></div>
        <div style="clear:both;float;none;"></div>
        <div class="vozmozhnosti_wrapper">
            <div class="vozmozhnosti">
                <div class="shrift">
                    <span class="razmer">
                        <?= GetMessage("font_size1") ?>
                    </span>
                    <span class="minus">-</span>
                    <span class="plus">+</span>
                </div>
                <a href="<?= $APPLICATION->GetCurUri("print=Y") ?>" target="_blank" class="pechat">
                    <?= GetMessage("print1") ?>
                </a>
            </div>
        </div>
    </div>
    <?
        $image = CFile::ResizeImageGet(
            $arResult["PREVIEW_PICTURE"],
            array(
                'width'  => 340,
                'height' => 255
            ),
            BX_RESIZE_IMAGE_PROPORTIONAL
        );
        $image = $image ? $image['src'] : "/images/no_photo.png";
    ?>

    <div class="pikachoose">
        <div class="mimages">
            <?
            ?>

            <img class="preview_picture" border="0" src="<?= $image; ?>" width="340" height="255"/>


        </div>
        <span class="mvideo">

        </span>
    </div>
    <div class="text" id="qaz">
        <?= $arResult["DETAIL_TEXT"]; ?>
    </div>
    <br/>

    <div style="clear:both;float;none;"></div>

    <?
        if (SITE_ID == "s1")
        {
            $share_ver = "ru";
        } elseif (SITE_ID == "s2")
        {
            $share_ver = "en";
        }
    ?>
    <script type="text/javascript">
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

    <script type="text/javascript" src="//yandex.st/share/share.js"
            charset="utf-8"></script>
    <div class="yashare-auto-init" data-yashareL10n="<?= $share_ver ?>"
         data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,lj,gplus"
        ></div>

    <h2 class="other"><?= "В новостях" ?>:</h2>


    <?
        $GLOBALS["arrFilterPerson"] = array(
            "PROPERTY_person" => $arResult['ID'],
        );
    ?>
    <?
        if (SITE_ID == 's1')
        {
            $iblock_id = 2;
            $iblock_type = "news";
        }
        if (SITE_ID == 's2')
        {
            $iblock_id = '16';
            $iblock_type = "news_en";
        }

        $component->arResult["LIST_SUB_NEWS"] = $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "main_theme_news",
            array(
                "DISPLAY_DATE"                    => "Y",
                "DISPLAY_NAME"                    => "Y",
                "DISPLAY_PICTURE"                 => "Y",
                "DISPLAY_PREVIEW_TEXT"            => "Y",
                "AJAX_MODE"                       => "Y",
                "IBLOCK_TYPE"                     => $iblock_type,
                "IBLOCK_ID"                       => $iblock_id,
                "NEWS_COUNT"                      => "30",
                "SORT_BY1"                        => "ACTIVE_FROM",
                "SORT_ORDER1"                     => "DESC",
                "SORT_BY2"                        => "SORT",
                "SORT_ORDER2"                     => "ASC",
                "FILTER_NAME"                     => "arrFilterPerson",
                "FIELD_CODE"                      => "",
                "PROPERTY_CODE"                   => "",
                "CHECK_DATES"                     => "Y",
                "DETAIL_URL"                      => "",
                "PREVIEW_TRUNCATE_LEN"            => "",
                "ACTIVE_DATE_FORMAT"              => "d.m.Y",
                "SET_TITLE"                       => "N",
                "SET_STATUS_404"                  => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
                "ADD_SECTIONS_CHAIN"              => "N",
                "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
                "PARENT_SECTION"                  => "",
                "PARENT_SECTION_CODE"             => "",
                "CACHE_TYPE"                      => "A",
                "CACHE_TIME"                      => "360000",
                "CACHE_FILTER"                    => "Y",
                "CACHE_GROUPS"                    => "Y",
                "DISPLAY_TOP_PAGER"               => "N",
                "DISPLAY_BOTTOM_PAGER"            => "N",
                "PAGER_TITLE"                     => "Страница",
                "PAGER_SHOW_ALWAYS"               => "Y",
                "PAGER_TEMPLATE"                  => "",
                "PAGER_DESC_NUMBERING"            => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL"                  => "Y",
                "AJAX_OPTION_SHADOW"              => "Y",
                "AJAX_OPTION_JUMP"                => "Y",
                "AJAX_OPTION_STYLE"               => "Y",
                "AJAX_OPTION_HISTORY"             => "Y"
            ),
            $component,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        ); ?>

</div>

