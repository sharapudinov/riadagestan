<?php
include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
/**
 * Created by PhpStorm.
 * User: SHOMA
 * Date: 10.08.14
 * Time: 1:28
 */

$date = date("d.m.Y");
$from = htmlspecialcharsEx($_REQUEST['from']);
$to = htmlspecialcharsEx($_REQUEST['to']);

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script src="../date.js"></script>
    <script src="../ui/external/jquery/jquery.js"></script>
    <script src="../ui/jquery-ui.min.js"></script>
    <link type="text/css" href="../ui/jquery-ui.min.css" rel="stylesheet"/>
    <style>
        body {
            font: normal 9pt Arial, sans-serif;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#from").datepicker();
            $("#from").datepicker("option", "dateFormat", "dd.mm.yy");
            $("#to").datepicker();
            $("#to").datepicker("option", "dateFormat", "dd.mm.yy");
            var today = new Date();
            $("#from").val(<?=$from ? '"' . $from . '"' : 'today.toString("dd.MM.yyyy")'?>);
            $("#to").val(<?=$to ? '"' . $to . '"' : '$("#from").val()'?>);
        });


    </script>

</head>
<body>
<form method="get">
    <table>
        <tr>
            <td>С <input type="text" id="from" name="from"></td>
            <td>по <input type="text" id="to" name="to"></td>
            <td>строка поиска <input type="search" id="to" name="query"
                                     value="<?= htmlspecialcharsEx($_REQUEST['query']) ?>"></td>
            <td><input type="submit"></td>
            <?
            //    var_dump($authorReq[0]);
            //    print strtolower($authorReq[0]);
            $datefilter = $from . $to ? Array(">=DATE_CHANGE" => $from . " 00:00", "<=DATE_CHANGE" => $to . " 23:59") : Array('>=DATE_CREATE' => $date);

            if (CModule::IncludeModule('search')) {

                $q = htmlspecialcharsEx($_REQUEST['query']);

                $module_id = "iblock";

                $param1 = 'news';

                $param2 = 2;

                $obSearch = new CSearch($q, 's1', $module_id, false, $param1, $param2,array(),array($datefilter));
            ?>
            <td>
                <h3> Всего новостей : <?= $obSearch->SelectedRowsCount() ?></h3>
            </td>
            <?
            }
            ?>
        </tr>
    </table>
</form>

<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>
</body>
</html>