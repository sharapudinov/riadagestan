<?php
/**
 * Created by PhpStorm.
 * User: Asus-
 * Date: 10.01.2015
 * Time: 11:16
 */

if($arResult["SECTION"]["PATH"][1]["NAME"] == null):
    $title=$arResult["SECTION"]["PATH"][0]["NAME"];
else:
    $title= $arResult["SECTION"]["PATH"][1]["NAME"];
endif;

$APPLICATION->SetPageProperty('title', $title);
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/smoothDivScroll.css');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH .'/js/jquery.smoothdivscroll-1.3-min.js');
?>

<script type="text/javascript">
    // Initialize the plugin with no custom options
    $(document).ready(function () {
        // I just set some of the options
        $("#makeMeScrollable").smoothDivScroll({
            touchScrolling: true,
            manualContinuousScrolling: false,
            hotSpotScrolling: false,
            mousewheelScrolling: false
        });
    });
</script>