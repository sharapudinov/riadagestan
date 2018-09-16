<?php

/**
 * Created by PhpStorm.
 * User: SHOMA
 * Date: 20.08.14
 * Time: 16:33
 */

include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');


$date=date("d.m.Y");
$from=htmlspecialcharsEx($_REQUEST['from']);
$to=htmlspecialcharsEx($_REQUEST['to']);
$datefilter=$from.$to?Array(">=DATE_ACTIVE_FROM"=>$from." 00:00","<=DATE_ACTIVE_FROM"=>$to." 23:59"):Array('>=DATE_ACTIVE_FROM'=>$date);
//var_dump($_REQUEST['author'])

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
    <script>
        $(document).ready(function(){
            $("#from").datepicker();
            $("#from").datepicker("option", "dateFormat", "dd.mm.yy");
            $("#to").datepicker();
            $("#to").datepicker("option", "dateFormat", "dd.mm.yy");
            var today=new Date();
            $("#from").val(<?=$from?'"'.$from.'"':'today.toString("dd.MM.yyyy")'?>);
            $("#to").val(<?=$to?'"'.$to.'"':'$("#from").val()'?>);
        });


    </script>

</head>
<body>
<form method="get" >
    <table>
        <tr>
            <td>С <input type="text" id="from" name="from"></td>
            <td>по <input type="text" id="to" name="to"></td>

            <td><input type="submit"></td>
            <?
            $arSelect = Array("ID", "IBLOCK_ID","NAME","SHOW_COUNTER","PROPERTY_AUTHOR","DATE_ACTIVE_FROM","DETAIL_PAGE_URL");
            $arFilter = Array("IBLOCK_ID"=>2,"SUBSECTION"=>htmlspecialcharsEx($_REQUEST['section_id']),$datefilter);
            $res_el=CIBlockElement::GetList(Array("SHOW_COUNTER"=>'DESC'),$arFilter,false,false,$arSelect);
            ?>
            <td>
                <h3> Всего новостей : <?=$res_el->SelectedRowsCount()?></h3>
            </td>
        </tr>
    </table>
</form>
<div>
    <table>
        <thead>
        <td style="text-align: center">
            <h3> Новости</h3>
        </td>
        <td style="text-align: center">
            <h3>Количество просмотров</h3>
        </td>

        <td style="text-align: center" >
            <h3>Дата создания </h3>
        </td>
        </thead>
        <tbody>
        <?
        while($ob_el = $res_el->GetNextElement())
        {
        $arFieldsEl = $ob_el->GetFields();
        ?>
        <tr>
            <td style="width: 500px">
                <a href="<?=$arFieldsEl['DETAIL_PAGE_URL']?>"><?=$arFieldsEl['NAME'];?></a>
            </td>
            <td style="text-align: center; width: 200px">
                <?=$arFieldsEl['SHOW_COUNTER'];?>
            </td>
            <td>
                <?=$arFieldsEl["DATE_ACTIVE_FROM"];?>
            </td>
            <?
            }
            ?>
        </tr>

        </tbody>
    </table>
</div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
</body>
</html>