<?$APPLICATION->IncludeFile("/include/adv/sidebar_1.php",array(),array("MODE"=>"html", "NAME" => "ђекламнаЯ область"))?>
<?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "simple" ,Array(
        "USE_PERSONALIZATION" => "Y", 
        "PAGE" => "/nw/personal/subscribe/subscr_edit.php", 
        "SHOW_HIDDEN" => "Y", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "3600" 
    )
);?>