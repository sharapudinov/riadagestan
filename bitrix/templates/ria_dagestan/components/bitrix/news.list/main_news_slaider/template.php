<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//test_dump($USER,$arResult);

$this->setFrameMode(true);

if (count($arResult["ITEMS"]) > 0): ?>
    <div class="rslides_container">
        <ul class="rslides">
            <?$reverse=array_reverse($arResult["ITEMS"]);?>
            <? foreach ($reverse as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"));
                ?>
                <li>
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <img src="<?= $arItem["IPROPERTY_VALUES"]["PREVIEW_IMG_MEDIUM"]["src"] ?>"
                             width="<?= $arParams["DISPLAY_IMG_WIDTH"] ?>"
                             height="<?= $arParams["DISPLAY_IMG_HEIGHT"] ?>"
                             alt="<?= $arItem["NAME"] ?>"
                             title="<?= $arItem["NAME"] ?>"/>
                    </a>

                    <div class="item_text">
                        <?= $arItem["NAME"] ?>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>

        <script>

            $(function () {
                $(".rslides").responsiveSlides();
            });
            $(".rslides").responsiveSlides({
                auto: true,             // Boolean: Animate automatically, true or false
                speed: 500,            // Integer: Speed of the transition, in milliseconds
                timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
                pager: true,           // Boolean: Show pager, true or false
                nav: true,             // Boolean: Show navigation, true or false
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
    </div>
<? endif; ?>

