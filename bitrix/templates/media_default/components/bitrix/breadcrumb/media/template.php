<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;

$strReturn = '';

$strReturn .= '<nav aria-label="breadcrumb"><ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]['TITLE']);

    if ($arResult[$index]['LINK'] <> '' && $arResult[$index]['LINK'] != $APPLICATION->GetCurPage()) {
        $strReturn .= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'.
                '<a itemprop="item" href="'.$arResult[$index]['LINK'].'" title="'.$title.'">'.
                    ' <span itemprop="name">'.$title.'</span>'.
                    '<meta itemprop="position" content="'.($index + 1).'">'.
                '</a>'.
            '</li>';
    } else {
        $strReturn .= ' <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'.
                ' <span itemprop="name">'.$title.'</span>'.
                '<meta itemprop="position" content="'.($index + 1).'">'.
            '</li>';
    }
}

$strReturn .= '</ol></nav>';

return $strReturn;
