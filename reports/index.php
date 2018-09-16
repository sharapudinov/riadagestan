<?php
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/**
* Created by PhpStorm.
* User: SHOMA
* Date: 08.08.14
* Time: 16:57
*/

$date=date("d.m.Y");
$from=htmlspecialcharsEx($_REQUEST['from']);
$to=htmlspecialcharsEx($_REQUEST['to']);
$datefilter=$from.$to?Array(">=DATE_ACTIVE_FROM"=>$from." 00:00","<=DATE_ACTIVE_FROM"=>$to." 23:59"):Array('>=DATE_ACTIVE_FROM'=>$date);

//var_dump($datefilter);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="date.js"></script>
    <script src="ui/external/jquery/jquery.js"></script>
    <script src="ui/jquery-ui.min.js"></script>
    <link type="text/css" href="ui/jquery-ui.min.css" rel="stylesheet" />
    <style>
        body{font:normal 9pt Arial,sans-serif;}
    </style>
</head>
<body>
<form method="get" >
<table>
    <tr>
        <td>С <input type="text" id="from" name="from"></td>
        <td>по <input type="text" id="to" name="to"></td>
        <td><input type="submit"></td>
    </tr>
</table>

</form>
<script>
    $(document).ready(function(){
        $("#from").datepicker();
        $("#from").datepicker( $.datepicker.regional["ru"] );
        $("#from").datepicker("option", "dateFormat", "dd.mm.yy");
        $("#to").datepicker();
        $("#to").datepicker("option", "dateFormat", "dd.mm.yy");
        var today=new Date();
        $("#from").val(<?=$from?'"'.$from.'"':'today.toString("dd.MM.yyyy")'?>);
        $("#to").val(<?=$to?'"'.$to.'"':'$("#from").val()'?>);
    });


</script>


<?

?>
<div>
     <table>
         <thead>
         <td>
            <h3> Муниципалитет</h3>
         </td>
         <td>
           <h3> Количество новостей</h3>
         </td>
         <td>
             <h3>Количество просмотров</h3>
         </td>
                  </thead>
<?
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "NAME",);
    $arFilter = Array("IBLOCK_ID"=>2,"SECTION_ID"=>94);
    $res_sec = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect,bShowAll);
    while($ob_sec = $res_sec->GetNextElement()){
?>
    <tr>
<?$arFieldsSec = $ob_sec->GetFields();?>
         <td>
            <?=$arFieldsSec['NAME']?>
        </td>

           <?
                $arSelect = Array("ID", "IBLOCK_ID","SHOW_COUNTER");
                $arFilter = Array("IBLOCK_ID"=>2,"SECTION_ID"=>$arFieldsSec['ID'],$datefilter);
                $res_el=CIBlockElement::GetList(Array(),$arFilter,false,false,$arSelect);
           ?>
        <td style="text-align: center">
            <?=$res_el->SelectedRowsCount().'</td><td style="text-align: center">';
                $show_count=0;
                while($ob_el = $res_el->GetNextElement()){
                    $arFieldsEl = $ob_el->GetFields();
                    $show_count+= $arFieldsEl['SHOW_COUNTER'];
                }
            print $show_count.$arFieldsEl["DATE_ACTIVE_FROM"];
           ?>
        </td>

    </tr>
<?
    }
?>
    </table>
</div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
</body>
</html>