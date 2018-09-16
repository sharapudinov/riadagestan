<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->RestartBuffer();
//test_dump($arResult);

$jsonArray = array_map(function ($item) {
    $img= CFile::GetFileArray($item['DISPLAY_PROPERTIES']['IMAGES']['VALUE'][0]);
    return array(
        'title' => $item['NAME'],
        'link' => $item['DETAIL_PAGE_URL'],
        'description' => $item['DETAIL_TEXT'],
        'link' => str_replace('/api','',$item['DETAIL_PAGE_URL']),
        'yandex:full-text' => $item['DETAIL_TEXT'],
        'pubDate' => $item['ACTIVE_FROM'],
        'category' => $item['SECTION'],
        'video' => $item['PROPERTIES']['video_iframe']['VALUE'],
        'picture' =>is_set($item['PREVIEW_PICTURE']['SRC'])?$item['PREVIEW_PICTURE']['SRC']:$img['SRC'],

    );
}, $arResult['ITEMS']);

echo (json_encode($jsonArray));
