<?php
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
/**
 * Created by PhpStorm.
 * User: SHOMA
 * Date: 10.08.14
 * Time: 1:28
 */

$date=date("d.m.Y");
$from=htmlspecialcharsEx($_REQUEST['from']);
$to=htmlspecialcharsEx($_REQUEST['to']);
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
            <td>тег <input type="search" id="to" name="tag" value="<?=htmlspecialcharsEx($_REQUEST['tag'])?>"></td>
            <td>раздел
                <select  id="section_id" name="section_id">
                        <option <?=htmlspecialcharsEx($_REQUEST['section_id'])?'':'selected'?>>Все разделы</option>
                        <?
                        $arSelect = Array("ID", "NAME",);
                        $arFilter = Array("IBLOCK_ID"=>2);
                        $res_sec = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect,bShowAll);
                        while($ob_sec = $res_sec->GetNextElement()){
                            $arFieldsSec = $ob_sec->GetFields();?>
                            <option <?=htmlspecialcharsEx($_REQUEST['section_id'])==$arFieldsSec['ID']?'selected':''?> value="<?=$arFieldsSec['ID']?>">
                            <?=$arFieldsSec['NAME'] ?>
                            </option>
                        <?
                        }
                        ?>

                </select>
            </td>
            <td>автор: <input type="search" name="author" value="<?=htmlspecialcharsEx($_REQUEST['author'])?>"></td>
            <td><input type="submit"></td>
            <?
           $authorReq=explode(' ',htmlspecialcharsEx($_REQUEST['author']));
        //    var_dump($authorReq[0]);
        //    print strtolower($authorReq[0]);
            $authorFilter=htmlspecialcharsEx($_REQUEST['author'])?"($authorReq[0]_$authorReq[1]) || ($authorReq[1]_$authorReq[0])":'';
            $datefilter=$from.$to?Array(">=DATE_ACTIVE_FROM"=>$from." 00:00","<=DATE_ACTIVE_FROM"=>$to." 23:59"):Array('>=DATE_ACTIVE_FROM'=>$date);

            $arSelect = Array("ID", "IBLOCK_ID","NAME","SHOW_COUNTER","PROPERTY_AUTHOR","DATE_ACTIVE_FROM","DETAIL_PAGE_URL");
            $arFilter = Array("IBLOCK_ID"=>2,"SUBSECTION"=>htmlspecialcharsEx($_REQUEST['section_id']),$datefilter,"TAGS"=>"%".$_REQUEST['tag']."%","?PROPERTY_AUTHOR"=>$authorFilter);
            $res_el=CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>'DESC'),$arFilter,false,false,$arSelect);
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
        <td style="text-align: center">
            <h3>Автор</h3>
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
                $arAuthors=explode(',',$arFieldsEl['PROPERTY_AUTHOR_VALUE']);

                for($counter=0;$counter<count($arAuthors);$counter++){
                    $arAuthors[$counter]=explode(' ',trim($arAuthors[$counter]));
                }

                if (strtolower($arAuthors[0][0])==strtolower($authorReq[0])&&strtolower($arAuthors[0][1])==strtolower($authorReq[1]) ||
                    strtolower($arAuthors[0][1])==strtolower($authorReq[0])&& strtolower($arAuthors[0][0])==strtolower($authorReq[1]) ||
                    !htmlspecialcharsEx($_REQUEST['author']))
                {


        ?>
            <tr>
                <td style="width: 500px">
                <a href="<?=$arFieldsEl['DETAIL_PAGE_URL']?>"><?=$arFieldsEl['NAME'];?></a>
                </td>
                <td style="text-align: center">
                <?=$arFieldsEl['SHOW_COUNTER'];?>
                </td>
                <td style="width: 200px; text-align: center">
                <?=$arFieldsEl['PROPERTY_AUTHOR_VALUE'];?>
                </td>
                <td>
                <?=$arFieldsEl["DATE_ACTIVE_FROM"];?>
                </td>
        <?
                 }
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