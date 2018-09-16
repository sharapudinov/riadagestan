<?php
define("NEED_AUTH", "Y");
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$param_upload_dir = COption::GetOptionString("shopolia.images", "upload_dir", "/upload/ajax_uploads/"); // ip2long($_SERVER['REMOTE_ADDR'])
if (!file_exists($_SERVER["DOCUMENT_ROOT"].$param_upload_dir)) @mkdir($_SERVER["DOCUMENT_ROOT"].$param_upload_dir);

$uploaddir = $param_upload_dir.$USER->GetID()."/"; // ip2long($_SERVER['REMOTE_ADDR'])
if (!file_exists($_SERVER["DOCUMENT_ROOT"].$uploaddir)) @mkdir($_SERVER["DOCUMENT_ROOT"].$uploaddir);

$allowed_exts = array("jpg", "jpeg", "gif", "png");
$filename = basename($_FILES['file']['name']);
$ext = pathinfo($_SERVER["DOCUMENT_ROOT"].$uploaddir.$filename, PATHINFO_EXTENSION);

if (in_array(strtolower($ext), $allowed_exts)) {
    $filename = md5(microtime(true)).".".$ext;
    @move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER["DOCUMENT_ROOT"].$uploaddir.$filename);
    echo $filename;
} else {
    echo "error";
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>