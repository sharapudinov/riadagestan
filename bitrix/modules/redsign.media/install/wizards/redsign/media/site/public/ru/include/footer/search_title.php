<?php
$APPLICATION->IncludeComponent(
    'bitrix:search.title',
    'type1',
    array(
        "SHOW_INPUT" => "Y",
        "INPUT_ID" => "title-search-input",
        "CONTAINER_ID" => "title-search",
        "PRICE_CODE" => array(),
        "PRICE_VAT_INCLUDE" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "150",
        "SHOW_PREVIEW" => "Y",
        "PREVIEW_WIDTH" => "75",
        "PREVIEW_HEIGHT" => "75",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "PAGE" => "#SITE_DIR#search/index.php",
        "NUM_CATEGORIES" => "0",
        "TOP_COUNT" => "4",
        "ORDER" => "date",
        "USE_LANGUAGE_GUESS" => "Y",
        "CHECK_DATES" => "Y",
        "SHOW_OTHERS" => "Y",
        "CATEGORY_0_TITLE" => "Статьи",
        "CATEGORY_0" => array("iblock_articles"),
        "CATEGORY_0_iblock_articles" => array("all"),
    ));
?>