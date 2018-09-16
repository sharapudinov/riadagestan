<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<? if(count($arResult['CBR']['CUR'])):?>
<div class="cur_title_name"><?=GetMessage('TITLE')?></div>
<div class="cur_block" id='cur_currency_some'>
    <table width="100%">
	 <? 
	 foreach($arResult['CBR']['CUR'] as $v):
	 	$img = "";
		$zn = "";
		$class = "";
	 	if($v['CHANGE'] == 'up')
		{
			$img = '<div class="cur_'.$arParams['STYLE'].'_up"></div>';
			$zn = '+';
			$class = 'cur_val_up_val';
		}
		if($v['CHANGE'] == 'down')
		{
			$img = '<div class="cur_'.$arParams['STYLE'].'_down"></div>';
			$zn = '-';
			$class = 'cur_val_down_val';
		}
	 ?>
            <tr>
                <td>
                    <div class="cur_val_img"><?=$v['NAME']?></div>
                </td>
                <td><?=$v['VAL']?></td>
                <td><?=$img?></td>
                <td><span class="<?=$class?>"><?=$zn.$v['CHVAL']?></span></td>
            </tr>
	<? endforeach?>
        	<tr>
                <td colspan="4"><div class="cur_on_date"><?=GetMessage('DATE')?> <?=$arResult['CBR']['DATE']?></div></td>
            </tr>
     </table>
     

</div>
<? endif?>