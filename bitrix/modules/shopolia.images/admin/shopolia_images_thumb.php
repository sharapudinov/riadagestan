<?php
if (isset($_GET['name'])) {
    define("NO_KEEP_STATISTIC", true);
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    if ($USER->IsAuthorized()) {
        $param_upload_dir = COption::GetOptionString("shopolia.images", "upload_dir", "/upload/ajax_uploads/");
        if (!file_exists($_SERVER["DOCUMENT_ROOT"].$param_upload_dir)) @mkdir($_SERVER["DOCUMENT_ROOT"].$param_upload_dir); // пытаемся создать общую папку для загрузок
        $uploadpath = $param_upload_dir.$USER->GetID()."/"; // ip2long($_SERVER['REMOTE_ADDR'])
        $uploaddir = $_SERVER["DOCUMENT_ROOT"].$uploadpath;
        if (!file_exists($uploaddir)) mkdir($uploaddir); // пытаемся создать папку для загрузок текущего пользователя
        $allowed_exts = array("jpg", "jpeg", "gif", "png");
        $filename = basename($_GET['name']);
        $thumb_width = $_GET['w']?intval($_GET['w']):100;
        $thumb_height = $_GET['h']?intval($_GET['h']):75;
        if (in_array(strtolower(pathinfo($uploaddir.$filename, PATHINFO_EXTENSION)), $allowed_exts)) {
            if (file_exists($uploaddir.$filename)) {
                if (CFile::IsImage($_SERVER['DOCUMENT_ROOT'].$uploadpath.$filename)) {
                    $thumb_dest = $_SERVER['DOCUMENT_ROOT'].$uploadpath.str_replace(".", "_thumb.", $filename);
                    $thumb_url = $uploadpath.str_replace(".", "_thumb.", $filename);
                    CFile::ResizeImageFile($_SERVER['DOCUMENT_ROOT'].$uploadpath.$filename, $thumb_dest, array('width'=>$thumb_width, 'height'=>$thumb_height), BX_RESIZE_IMAGE_PROPORTIONAL);
                    if (file_exists($thumb_dest)) LocalRedirect($thumb_url);
                } else {
                    echo "The chosen file is not an image file";
                }
            } else {
                echo "File does not exist";
            }
        } else {
            echo "Wrong extension";
            @unlink($uploaddir.$uploaddir);
        }
    } else {
        echo "Unauthorized";
    }
} else {
    echo "No name";
}


?>