<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
		
			//print_r($arResult);
			// $arResult["currentMonth"]
			// $arResult["currentYear"]
			if(strlen($arResult["currentMonth"]) == 1){
				$month_m = "0".$arResult["currentMonth"];
			}else{
				$month_m = $arResult["currentMonth"];
			}
?>
<div class="news-calendar">
	<?if($arParams["SHOW_CURRENT_DATE"]):?>
		<!--<p align="right" class="NewsCalMonthNav" style="margin: 10px; padding: 0; font-size:16px;"><b><?=$arResult["TITLE"]?></b></p>-->
	<?endif?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="NewsCalMonthNav" align="left">
				
					<a href="<?=$arResult["PREV_MONTH_URL"]?>" class="l123" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>"><?//=GetMessage("IBL_NEWS_CAL_PR_M")?></a>
				
				<?if($arResult["PREV_MONTH_URL"] && $arResult["NEXT_MONTH_URL"] && !$arParams["SHOW_MONTH_LIST"]):?>
					&nbsp;&nbsp;|&nbsp;&nbsp;
				<?endif?>
				<?if($arResult["SHOW_MONTH_LIST"]):?>
					&nbsp;&nbsp;
					<select onChange="b_result()" name="MONTH_SELECT" id="month_sel">
						<?foreach($arResult["SHOW_MONTH_LIST"] as $month => $arOption):?>
							<option value="<?=$arOption["VALUE"]?>" arr="<?print_r($arOption);?>" <?if($arResult["currentMonth"] == $month) echo "selected";?>><?=$arOption["DISPLAY"]?></option>
						<?endforeach?>
					</select>
					&nbsp;&nbsp;
					<script language="JavaScript" type="text/javascript">
					<!--
					function b_result()
					{
						var idx=document.getElementById("month_sel").selectedIndex;
						<?if($arParams["AJAX_ID"]):?>
							BX.ajax.insertToNode(document.getElementById("month_sel").options[idx].value, 'comp_<?echo CUtil::JSEscape($arParams['AJAX_ID'])?>', <?echo $arParams["AJAX_OPTION_SHADOW"]=="Y"? "true": "false"?>);
						<?else:?>
							window.document.location.href=document.getElementById("month_sel").options[idx].value;
						<?endif?>
					}
					-->
					</script>
				<?endif?>
				
					<a href="<?=$arResult["NEXT_MONTH_URL"]?>" class="r123" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>"><?//=GetMessage("IBL_NEWS_CAL_N_M")?></a>
				
			</td>
			<?if($arParams["SHOW_YEAR"]):?>
			<td class="NewsCalMonthNav" align="right">
				<?if($arResult["PREV_YEAR_URL"]):?>
					<!--<a href="<?=$arResult["PREV_YEAR_URL"]?>" class="l321" title="<?=$arResult["PREV_YEAR_URL_TITLE"]?>"><?//=GetMessage("IBL_NEWS_CAL_PR_Y")?></a>-->
				<?endif?>
					<select onChange="b_result2()" name="MONTH_SELECT" id="month_sel1">
							<option value="<?="?year=2005"?>" <? if($arResult["currentYear"] == "2005") echo "selected";?> >2005</option>					
							<option value="<?="?year=2006"?>" <? if($arResult["currentYear"] == "2006") echo "selected";?> >2006</option>					
							<option value="<?="?year=2007"?>" <? if($arResult["currentYear"] == "2007") echo "selected";?> >2007</option>					
							<option value="<?="?year=2008"?>" <? if($arResult["currentYear"] == "2008") echo "selected";?> >2008</option>					
							<option value="<?="?year=2009"?>" <? if($arResult["currentYear"] == "2009") echo "selected";?> >2009</option>					
							<option value="<?="?year=2010"?>" <? if($arResult["currentYear"] == "2010") echo "selected";?> >2010</option>					
							<option value="<?="?year=2011"?>" <? if($arResult["currentYear"] == "2011") echo "selected";?> >2011</option>					
							<option value="<?="?year=2012"?>" <? if($arResult["currentYear"] == "2012") echo "selected";?> >2012</option>					
							<option value="<?="?year=2013"?>" <? if($arResult["currentYear"] == "2013") echo "selected";?> >2013</option>					
					</select>
					<script language="JavaScript" type="text/javascript">
					<!--
					function b_result2()
					{
						var idx=document.getElementById("month_sel1").selectedIndex;
						
							window.document.location.href=document.getElementById("month_sel1").options[idx].value;
						
					}
					-->
					</script>
				<?if($arResult["NEXT_YEAR_URL"]):?>	
					<!--<a href="<?=$arResult["NEXT_YEAR_URL"]?>" class="r321" title="<?=$arResult["NEXT_YEAR_URL_TITLE"]?>"><?//=GetMessage("IBL_NEWS_CAL_N_Y")?></a>-->
				<?endif?>				
			</td>
			<?endif?>
		</tr>
	</table>
	<br />
	<table width='100%' border='0' cellspacing='1' cellpadding='4' class='NewsCalTable'>
	<tr>
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<td class='NewsCalHeader'><?=$WDay["SHORT"]?></td>
	<?endforeach?>
	</tr>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<td align="left" valign="top" class='<?=$arDay["td_class"]?>'>
		<?if(m_check_date($arDay["day"], $month_m, $arResult["currentYear"])):?>
			<span class="<?=$arDay["day_class"]?>"><a href="#lenta" class="getlenta" atr="mmmdata=<?=$arDay["day"]?>.<?=$month_m;?>.<?=$arResult["currentYear"]?>"><?=$arDay["day"]?></a></span>
		<?else:?>
			<span class="<?=$arDay["day_class"]?>"><a><?=$arDay["day"]?></a></span>
		<?endif;?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
</div>
