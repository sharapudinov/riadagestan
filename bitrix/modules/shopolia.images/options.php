<?php
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

CModule::IncludeModule("iblock");
$aTabs = array(
    array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "shopolia_images_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
);  

$tabControl = new CAdminTabControl("tabControl", $aTabs);

// Сохранение настроек модуля
if ($REQUEST_METHOD=="POST" AND strlen($Update.$Apply.$RestoreDefaults)>0 AND check_bitrix_sessid()) {
    $arErrors = array();
    
    if ($_REQUEST["upload_dir"]) {
        $test_dir = $_SERVER['DOCUMENT_ROOT'].$_REQUEST["upload_dir"];
        if (!file_exists($test_dir)) 
            if (!@mkdir($test_dir)) $arErrors[] = GetMessage("SHOPOLIA_IMAGES_DIR_NOT_CREATED");
        //if (!is_dir($test_dir) OR !is_link($test_dir)) $arErrors[] = "Указан на раздел";
        if (!is_writable($test_dir)) $arErrors[] = GetMessage("SHOPOLIA_IMAGES_DIR_WRITE_DISABLED");
        elseif (!is_readable($test_dir)) $arErrors[] = GetMessage("SHOPOLIA_IMAGES_DIR_READ_DISABLED");
        if (substr($_REQUEST["upload_dir"], -1, 1)!="/") $_REQUEST["upload_dir"] .= "/"; // добавляем слеш, если забыли
    }
    
    if (!empty($arErrors)) {
        echo ShowError(implode("<br>", $arErrors));
    } else {
        // Сохранение настроек с первой вкладки
        if (strlen($RestoreDefaults)>0) {
            COption::RemoveOption("shopolia.images");
        } else {
            COption::SetOptionString("shopolia.images", "jquery_link", $_REQUEST["jquery_link"]);
            COption::SetOptionString("shopolia.images", "upload_dir", $_REQUEST["upload_dir"]);
        }
        if (strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0) LocalRedirect($_REQUEST["back_url_settings"]);
        else LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
    }
}

$tabControl->Begin();
?>

<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>"><?
$tabControl->BeginNextTab();
?>
        <tr>
            <td width="50%" class="adm-detail-content-cell-l"><?=GetMessage("SHOPOLIA_IMAGES_JQUERY_URL")?>:</td>
            <td width="50%" class="adm-detail-content-cell-r">
                <input type="text" name="jquery_link" value="<?=COption::GetOptionString("shopolia.images", "jquery_link", "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js")?>" size="60">
            </td>
        </tr>
        <tr>
            <td width="50%" class="adm-detail-content-cell-l"><?=GetMessage("SHOPOLIA_IMAGES_TEMP_UPLOAD_DIR")?>:</td>
            <td width="50%" class="adm-detail-content-cell-r">
                <input type="text" name="upload_dir" value="<?=COption::GetOptionString("shopolia.images", "upload_dir", "/upload/ajax_uploads/")?>" size="60">
            </td>
        </tr>
        <tr>
            <td width="50%" class="adm-detail-content-cell-l"></td>
            <td width="50%" class="adm-detail-content-cell-r">
                <?=GetMessage("SHOPOLIA_IMAGES_TEMP_UPLOAD_DIR_DESCR")?>
            </td>
        </tr>
        
<?$tabControl->Buttons();?>
    <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>">
    <input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
    <?if(strlen($_REQUEST["back_url_settings"])>0):?>
        <input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialchars(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
        <input type="hidden" name="back_url_settings" value="<?=htmlspecialchars($_REQUEST["back_url_settings"])?>">
    <?endif?>
    <input type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
    <?=bitrix_sessid_post();?>
<?$tabControl->End();?>
</form>