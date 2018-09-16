<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
//__($arResult);

$currNum = $arResult['NavPageNomer'];
$pagesCount = $arResult['NavPageCount'];

$visiblePagesCount = 3;
$step = floor($visiblePagesCount/2);

if ($pagesCount<=$visiblePagesCount+2)
{
    // for 5 pages it will be shown all pages on any page
    // without this block for first and second page there will be 1 2 3 ... 5, but for 3-rd - 1 2 3 4 5
    $startNumOfVisiblePages=1;
    $endNumOfVisiblePages=$pagesCount;
}
else
{
    $startNumOfVisiblePages = $currNum-$step;
    if ($startNumOfVisiblePages<1)
        $startNumOfVisiblePages=1;
    $endNumOfVisiblePages = $startNumOfVisiblePages + $visiblePagesCount - 1;
    if ($endNumOfVisiblePages > $pagesCount)
    {
        $endNumOfVisiblePages = $pagesCount;
        $startNumOfVisiblePages = max($endNumOfVisiblePages - $visiblePagesCount + 1, 0);
    }
}
$navUrl = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'=';

$showPageNumber = function ($num, $asDots = false) use($pagesCount, $currNum, $navUrl)
{	
	if ($num>$pagesCount || $num<1)
		return;	
	if ($currNum!=$num)
	{
		$url =$navUrl.$num;
		$text=$asDots?'...':$num;
		echo "<li><a href=\"$url\">$text</a></li>";
	}  
	else
		echo "<li><span class=\"act\">$num</span></li>";
}

?>
<div class="pager_bottom">
    <ul class="box_pager">
		<?php if ($currNum==1) { ?>
			<li class="left1"><a><?=GetMessage("previous")?><br/> 20 <?=GetMessage("materials")?></a></li>
		<?php } else {?> 
			<li class="left1"><a href="<?=$navUrl.($currNum-1)?>"><?=GetMessage("previous")?><br/> 20 <?=GetMessage("materials")?></a></li>
		<?php } ?>
		
		<?php 
			// if ($startNumOfVisiblePages > 1)
			// {
			// 	$showPageNumber(1);
			// 	if ($startNumOfVisiblePages>2)
			// 		$showPageNumber($startNumOfVisiblePages-1, true);
			// }
			// for ($i = $startNumOfVisiblePages; $i <= $endNumOfVisiblePages; $i++) {
			// 	$showPageNumber($i);
			// }
			// if ($endNumOfVisiblePages < $pagesCount)
			// {
			// 	if ($endNumOfVisiblePages < $pagesCount - 1)
			// 		$showPageNumber($endNumOfVisiblePages+1, true);
			// 	$showPageNumber($pagesCount);
			// }
		?>
		
		<?php if ($currNum==$pagesCount) { ?>
			<li class="right"><a><?=GetMessage("next")?><br/> 20 <?=GetMessage("materials")?></a></li>
		<?php } else {?>
			<li class="right"><a href="<?=$navUrl.($currNum+1)?>"><?=GetMessage("next")?><br/> 20 <?=GetMessage("materials")?></a></li>
		<?php } ?>		
	</ul>
</div>
