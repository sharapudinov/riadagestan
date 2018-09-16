<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

if (!empty($arResult)):
?>
<ul class="mobile-nav">
<?php
$previousLevel = 0;
foreach($arResult as $arItem):
?>
    <?php if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?php endif; ?>

    <?php if ($arItem["IS_PARENT"]): ?>
        <li class="mobile-nav-item">
            <a href="<?=$arItem['LINK']?>" class="mobile-nav-item__link"><?=$arItem['TEXT']?></a>
            <ul>
    <?php else: ?>
          <li class="mobile-nav-item"><a href="<?=$arItem['LINK']?>" class="mobile-nav-item__link"><?=$arItem['TEXT']?></a></li>
    <?php endif; ?>
<?php $previousLevel = $arItem["DEPTH_LEVEL"]; endforeach; ?>

<?php if ($previousLevel > 1): ?>
  <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?php endif; ?>
</ul>
<?php endif;
