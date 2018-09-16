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