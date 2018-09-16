<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
  die();
}

$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc;

$this->addExternalCSS(SITE_TEMPLATE_PATH.'/assets/vendor/jqueryNewsTicker/ticker-style.css');
$this->addExternalJS(SITE_TEMPLATE_PATH.'/assets/vendor/jqueryNewsTicker/jquery.ticker.js');
?>
<div class="l-trending">
    <div class="l-trending__title">
        <span class="fa fa-bolt d-inline d-sm-none"></span>
        <span class="d-none d-sm-inline"><?=Loc::getMessage('RS_TRENDING');?></span>
    </div>
    <div class="l-trending__items">
      <div style="position: absolute; left: 0; top: 0; width: 100%;">
          <ul class="d-none" id="trending-items">
              <?php foreach ($arResult['ITEMS'] as $arItem): ?>
              <li><a class="b-trending-news-item" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></li>
            <?php endforeach; ?>
          </ul>
      </div>
    </div>
</div>

<script>
  $("#trending-items").ticker({
    speed: 0.2,
    ajaxFeed: false,
    feedUrl: false,
    feedType: 'xml',
    htmlFeed: true,
    debugMode: false,
    controls: true,
    titleText: ' ',
    displayType: 'reveal',
    direction: 'ltr',
    pauseOnItems: 2000,
    fadeInSpeed: 600,
    fadeOutSpeed: 300
  });
</script>
