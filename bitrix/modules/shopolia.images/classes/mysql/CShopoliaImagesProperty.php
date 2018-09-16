<?php

IncludeModuleLangFile(__FILE__);

class CShopoliaImagesProperty {
    public static $counter = 0;
    public static $values = array();
    public static $html_controls_values = array();
    function GetUserTypeDescription() {
        return array(
            "PROPERTY_TYPE" => "F",
            "USER_TYPE" => "Shopolia_Images",
            "DESCRIPTION" => GetMessage("SHOPOLIA_IMAGES_PROPERTY_NAME"),
            "GetPropertyFieldHtml" => array("CShopoliaImagesProperty", "GetPropertyFieldHtml"),
            "CheckFields" => array("CShopoliaImagesProperty", "CheckFields"),
            "ConvertToDB" => array("CShopoliaImagesProperty", "ConvertToDB"),
            "ConvertFromDB" => array("CShopoliaImagesProperty", "ConvertFromDB"),
            "GetSettingsHTML" => array('CShopoliaImagesProperty','GetSettingsHTML'),
            "PrepareSettings" => array('CShopoliaImagesProperty','PrepareSettings'),
            "GetAdminListViewHTML" => array('CShopoliaImagesProperty','GetAdminListViewHTML'),
            "GetPropertyFieldHtmlMulty" => array('CShopoliaImagesProperty','GetPropertyFieldHtmlMulty')
        );
    }
    
    function OnAfterIBlockPropertyHandler(&$arFields) { 
        if ($arFields['USER_TYPE'] == "Shopolia_Images") {
            $arFields['MULTIPLE'] = "Y";
            if ($arFields['MULTIPLE_CNT'] < 2) $arFields['MULTIPLE_CNT'] = 2;
        }
    }
    function OnAfterIblockElementHandler (&$arFields) {
        global $USER, $DB;
        // resort values
        if ($_POST['shopolia_images_resort']>0) {
            $prop_id = intval($_POST['shopolia_images_resort']);
            if (is_array($_POST['PROP'][$prop_id]) AND !empty($_POST['PROP'][$prop_id])) {
                foreach ($_POST['PROP'][$prop_id] as $val_id=>$val) {
                    $val = $val['VALUE'];
                    $DB->Query("UPDATE b_iblock_element_prop_m1 SET `VALUE`=$val, `VALUE_NUM`=$val  WHERE ID=".$val_id);
                }
            }
        }
        //d($_POST);d($arFields);exit();
        // delete all user files from dir
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].COption::GetOptionString("shopolia.images", "upload_dir", "/upload/ajax_uploads/").$USER->GetID()."/";
        if (is_dir($uploaddir) AND is_writable($uploaddir)) {
            $handle = opendir($uploaddir);
            while (($file = readdir($handle))!==false) {
                if ($file!="." AND $file!="..") {
                    @unlink($uploaddir.'/'.$file);
                }
            }
            closedir($handle);
        }
    }
    
    
    function GetSettingsHTML ($arProperty, $strHTMLControlName, &$arPropertyFields) {
        $arPropertyFields = array("USER_TYPE_SETTINGS_TITLE" => GetMessage("SHOPOLIA_IMAGES_UPLOAD_PARAMS"));
        if (!$arProperty['USER_TYPE_SETTINGS']['THUMB_WIDTH']) $arProperty['USER_TYPE_SETTINGS']['THUMB_WIDTH'] = 100;
        if (!$arProperty['USER_TYPE_SETTINGS']['THUMB_HEIGHT']) $arProperty['USER_TYPE_SETTINGS']['THUMB_HEIGHT'] = 75;
        $html  = '  <tr>
                        <td>'.GetMessage("SHOPOLIA_IMAGES_IMAGES_RESIZE").':</td>
                        <td>
                            <input type="text" size="5" name="'.$strHTMLControlName["NAME"].'[UPLOAD_WIDTH]" value="'.$arProperty['USER_TYPE_SETTINGS']['UPLOAD_WIDTH'].'">
                            x
                            <input type="text" size="5" name="'.$strHTMLControlName["NAME"].'[UPLOAD_HEIGHT]" value="'.$arProperty['USER_TYPE_SETTINGS']['UPLOAD_HEIGHT'].'">
                            px
                        </td>
                    </tr>
                    <tr>
                        <td>'.GetMessage("SHOPOLIA_IMAGES_IMAGES_QUALITY").':</td>
                        <td>
                            <input type="text"  size="5" name="'.$strHTMLControlName["NAME"].'[UPLOAD_QUALITY]" value="'.$arProperty['USER_TYPE_SETTINGS']['UPLOAD_QUALITY'].'">
                            %
                        </td>
                    </tr>
                    <tr>
                        <td>'.GetMessage("SHOPOLIA_IMAGES_THUMBS_RESIZE").':</td>
                        <td>
                            <input type="text" size="5" name="'.$strHTMLControlName["NAME"].'[THUMB_WIDTH]" value="'.$arProperty['USER_TYPE_SETTINGS']['THUMB_WIDTH'].'">
                            x
                            <input type="text" size="5" name="'.$strHTMLControlName["NAME"].'[THUMB_HEIGHT]" value="'.$arProperty['USER_TYPE_SETTINGS']['THUMB_HEIGHT'].'">
                            px
                        </td>
                    </tr>
        ';
        
        return $html;
    }
    
    function PrepareSettings ($arFields) {
        if (empty($arFields["USER_TYPE_SETTINGS"]["THUMB_WIDTH"])) $arFields["USER_TYPE_SETTINGS"]["THUMB_WIDTH"] = 100;
        if (empty($arFields["USER_TYPE_SETTINGS"]["THUMB_HEIGHT"])) $arFields["USER_TYPE_SETTINGS"]["THUMB_HEIGHT"] = 75;
        return array(
            'UPLOAD_WIDTH' => trim($arFields["USER_TYPE_SETTINGS"]["UPLOAD_WIDTH"]),
            'UPLOAD_HEIGHT' => trim($arFields["USER_TYPE_SETTINGS"]["UPLOAD_HEIGHT"]),
            'UPLOAD_QUALITY' => trim($arFields["USER_TYPE_SETTINGS"]["UPLOAD_QUALITY"]),
            'THUMB_WIDTH' => trim($arFields["USER_TYPE_SETTINGS"]["THUMB_WIDTH"]),
            'THUMB_HEIGHT' => trim($arFields["USER_TYPE_SETTINGS"]["THUMB_HEIGHT"]),
        );
    }
    
    function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName) {
        if ($value['VALUE']) {
            $image_file = CFile::GetPath($value['VALUE']);
            $image_size = CFile::GetImageSize($_SERVER['DOCUMENT_ROOT'].$image_file);
            $image_filesize = filesize($_SERVER['DOCUMENT_ROOT'].$image_file);
            if ($image_filesize<1024) $image_filesize .= " ".GetMessage("SHOPOLIA_IMAGES_B");
            elseif ($image_filesize<1024*1024) $image_filesize = round($image_filesize/1024)." ".GetMessage("SHOPOLIA_IMAGES_KB");
            elseif ($image_filesize<1024*1024*1024) $image_filesize = (round($image_filesize*100/1024/1024)/100)." ".GetMessage("SHOPOLIA_IMAGES_MB");
            $image_thumb = $_SERVER['DOCUMENT_ROOT'].str_replace(".", "_thumb.", $image_file);
            $image_thumb_url = str_replace(".", "_thumb.", $image_file);
            CFile::ResizeImageFile($_SERVER['DOCUMENT_ROOT'].$image_file, $image_thumb, array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL);
            ob_start();
            ?>
                <?=ShowImage($image_thumb_url, 120, 120, 'id="shopolia_image_'.$value['VALUE'].'"')?>
                <script type="text/javascript">
                    new top.BX.CHint({
                        parent: top.BX("shopolia_image_<?=$value['VALUE']?>"),
                        show_timeout: 10,
                        hide_timeout: 200,
                        dx: 2,
                        preventHide: true,
                        min_width: 250,
                        hint: '<span class=\"adm-input-file-hint-row\"><?=GetMessage("SHOPOLIA_IMAGES_VOLUME")?>:&nbsp;&nbsp;<?=$image_filesize?></span><span class=\"adm-input-file-hint-row\"><?=GetMessage("SHOPOLIA_IMAGES_SIZE")?>:&nbsp;&nbsp;<?=$image_size[0]?>x<?=$image_size[1]?></span><span class=\"adm-input-file-hint-row\"><?=GetMessage("SHOPOLIA_IMAGES_LINK")?>:&nbsp;&nbsp;<a href=\"<?=$image_file?>\"><?=$image_file?></a></span>'
                    });
                </script>
            <?
            $return_html = ob_get_clean();
            return $return_html;
        }
    }
    
    function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName) {
        if ($strHTMLControlName['MODE']!="FORM_FILL") ob_start();
        if ($strHTMLControlName['MODE']!="FORM_FILL") {
            $jquery_link = COption::GetOptionString("shopolia.images", "jquery_link", "");
            if (strlen($jquery_link)) {
                echo '<script type="text/javascript" src="'.$jquery_link.'"></script>';
            }
            echo '<link rel="stylesheet" href="/bitrix/js/shopolia.images/jquery.plupload.queue/css/jquery.plupload.queue.css">';
            echo '<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>';
            echo '<script type="text/javascript" src="/bitrix/js/shopolia.images/plupload.full.js"></script>';
            echo '<script type="text/javascript" src="/bitrix/js/shopolia.images/jquery.plupload.queue/jquery.plupload.queue.js"></script>';
            echo '<script type="text/javascript" src="/bitrix/js/shopolia.images/jquery.sortable.js"></script>';
        }
        if (defined("ADMIN_SECTION")) {
            global $APPLICATION;
            $jquery_link = COption::GetOptionString("shopolia.images", "jquery_link", "");
            if (strlen($jquery_link)) {
                $APPLICATION->AddHeadScript($jquery_link);
            }
            $APPLICATION->AddHeadString('<link rel="stylesheet" href="/bitrix/js/shopolia.images/jquery.plupload.queue/css/jquery.plupload.queue.css">');
            $APPLICATION->AddHeadScript("http://bp.yahooapis.com/2.4.21/browserplus-min.js");
            $APPLICATION->AddHeadScript('/bitrix/js/shopolia.images/plupload.full.js');
            $APPLICATION->AddHeadScript("/bitrix/js/shopolia.images/jquery.plupload.queue/jquery.plupload.queue.js");
            $APPLICATION->AddHeadScript('/bitrix/js/shopolia.images/jquery.sortable.js');
        }
        
        $prop_name = $strHTMLControlName['VALUE'];
        $hash = "shopolia-images-".$arProperty['ID'];
        $upload_width = $arProperty['USER_TYPE_SETTINGS']['UPLOAD_WIDTH'];
        $upload_height = $arProperty['USER_TYPE_SETTINGS']['UPLOAD_HEIGHT'];
        $upload_quality = $arProperty['USER_TYPE_SETTINGS']['UPLOAD_QUALITY'];
        
        $thumb_width = $arProperty['USER_TYPE_SETTINGS']['THUMB_WIDTH']?intval($arProperty['USER_TYPE_SETTINGS']['THUMB_WIDTH']):120;
        $thumb_height = $arProperty['USER_TYPE_SETTINGS']['THUMB_HEIGHT']?intval($arProperty['USER_TYPE_SETTINGS']['THUMB_HEIGHT']):120;
        
?>
<style>
.sortable-placeholder {
    border: 2px dashed gray;
    width: <?=$thumb_width?>px;
    height: <?=$thumb_height?>px;
    float: left;
}
#<?=$hash?>-uploaded_images {
    width: 100%;
    min-height: <?=$thumb_height+4?>px;
    height: auto;
    background-color: #E0E8EA;
    margin-bottom: 10px;
}
#<?=$hash?>-uploaded_images br {
    clear: both;
}
#<?=$hash?>-uploaded_images span {
    display: inline-block;
    position: absolute;
    padding-top: 22px;
    min-height: <?=$thumb_height+4?>px;
    min-width: 360px;
    width: 100%;
    overflow: hidden;
    text-align: center;
    font-size: 24px;
    color: #F5F9F9;
    font-weight: bold;
}
#<?=$hash?>-uploaded_images label {
    width: <?=$thumb_width?>px; 
    height: <?=$thumb_height?>px;
    border: 1px solid #f5f5f5;
    display: inline-block;
    padding: 1px;
    float: left;
    text-align: center;
}
#<?=$hash?>-uploaded_images label:hover {
    border: 1px solid #ff5100;
}
#<?=$hash?>-uploaded_images .detail_picture_selected {
    background-color: #ff5100;
}
#<?=$hash?>-uploaded_images .photo_manage {
    color: #fff;
    display: none;
    position: absolute;
    z-index: 10;
    width: <?=$thumb_width?>px;
    height: <?=$thumb_height?>px;
}
#<?=$hash?>-uploaded_images .photo_manage a.delete_photo {
    background-color: #444;
}
#<?=$hash?>-uploaded_images .photo_manage div {
    padding: 2px 5px;
}
#<?=$hash?>-uploaded_images .photo_manage a {
    float: right;
    color: #fff;
    font-weight: bold;
    text-decoration: none;
    padding: 2px 5px;
}
.<?=$hash?>-swfupload-control {
    text-align: right;
    vertical-align: top;
}
.shopolia_images_label {
    position: absolute;
    z-index: 44;
    float: left;
    display: inline;
    color: #fff;
    font-size: 11px;
    font-weight: bold;
    background-color: #900;
    padding: 2px 4px;
}
.shopolia_images_small_warning {
    font-size: 11px;
    margin-top: 5px;
}
</style>
<script type="text/javascript">
$(function() {
    $('.sortable').sortable().bind('sortupdate', function(event, moved) {
        var counter = 0;
        $('.just_uploaded_<?=$hash?>').each(function(){
            $(this).attr('name', 'PROP[<?=$arProperty['ID']?>][n'+counter+'][VALUE]');
            counter++;
        });
    });
    var count_files = 0;
    var uploader = new plupload.Uploader({
        runtimes : 'gears,html5,flash,silverlight,browserplus',
        browse_button : '<?=$hash?>-pickfiles',
        container : '<?=$hash?>-upload_container',
        drop_element : '<?=$hash?>-upload_container',
        //max_file_size : '10mb',
        //max_file_count: 32,
        //chunk_size : '512kb', // начинает глючить с некоторыми файлами
        //unique_names : true,
        //rename: true,
        url : '/bitrix/admin/shopolia_images_upload.php',
        flash_swf_url : '/bitrix/js/shopolia.images/plupload.flash.swf',
        silverlight_xap_url : '/bitrix/js/shopolia.images/plupload.silverlight.xap',
        filters : [
            {title : "<?=GetMessage("SHOPOLIA_IMAGES_IMAGES")?>", extensions : "jpg,jpeg,gif,png"}
        ]
        <?if ($upload_width OR $upload_height):?>
            , resize : {
                <?if ($upload_width):?>width : <?=$upload_width?>, <?endif;?>
                <?if ($upload_height):?>height : <?=$upload_height?>, <?endif;?>
                quality : <?=$upload_quality?$upload_quality:90?>
            }
        <?endif;?>
    });

    uploader.bind('Init', function(up, params) {
        
    });

    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
        $('#<?=$hash?>-uploaded_images span').remove();
        uploader.start();
        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('UploadProgress', function(up, file) {
        var status_message = '';
        status_message = '<?=GetMessage("SHOPOLIA_IMAGES_FILE_UPLOADING")?> '+file.name+' ('+(count_files+1)+' <?=GetMessage("SHOPOLIA_IMAGES_FILE_UPLOADING_FROM")?> '+up.files.length+') '+file.percent+'%';
        $('#<?=$hash?>-upload_images_status').html(status_message);
    });

    uploader.bind('Error', function(up, err) {
        $('#<?=$hash?>-upload_images_status').append("<div>Error: " + err.code +
            ", Message: " + err.message +
            (err.file ? ", File: " + err.file.name : "") +
            "</div>"
        );

        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file, response) {
        if (response.response!="error") {
            var file_name = response.response;
            count_files++;
            $('#<?=$hash?>-uploaded_images br').remove();
            if (up.files.length==count_files) {
                $('#<?=$hash?>-upload_images_status').html('<strong style="color: green;"><?=GetMessage("SHOPOLIA_IMAGES_ALL_FILES_UPLOADED")?></strong>');
            }
            var img_src = '/bitrix/admin/shopolia_images_thumb.php?w=<?=$thumb_width?>&h=<?=$thumb_height?>&name='+file_name; // target_name
            var detail_hidden = '';
            var selected_class = '';
            var line = detail_hidden
            + '<label for="select_'+file.id+'"  '+selected_class+'  draggable="true">'
                + '<div class="shopolia_images_label"><?=GetMessage("SHOPOLIA_IMAGES_NEW")?></div>'
                + '<input type="hidden" name="PROP[<?=$arProperty['ID']?>][n'+(count_files-1)+'][VALUE]" value="'+file_name+'" class="just_uploaded_<?=$hash?>" />'
                + '<div class="photo_manage">'
                    + '<a href="#" class="delete_photo">X</a>'
                + '</div>'
                + '<img src="'+img_src+'" alt="" />' // width="<?=$thumb_width?>" height="<?=$thumb_height?>"
            + '</label>'
            $('#<?=$hash?>-uploaded_images').append(line+'<br>');
            $('.sortable').sortable();
            init_photo_manage();
        } else {
            $('#<?=$hash?>-upload_images_status').html('<strong class="red"><?=GetMessage("SHOPOLIA_IMAGES_ERROR_UNABLE_TO_UPLOAD_FILE")?> '+file.name+'</strong>');
        }
    });
    init_photo_manage();
});
function init_photo_manage() {
    $('#<?=$hash?>-uploaded_images label').mouseover(function(){
        $('.photo_manage').hide();
        $(this).find('.photo_manage').show();
    });
    $('#<?=$hash?>-uploaded_images label').mouseout(function(){
        $('.photo_manage').hide();
    });
    $('.delete_photo').click(function(){
        var id = $(this).attr('rel');
        if (id) { // для уже загруженных
            $(this).parent().parent().hide();
            $('#<?=$hash?>-del_image_'+id).removeAttr("disabled");
            $('#<?=$hash?>-hidden_image_'+id).removeAttr("disabled");
        } else { // для еще не загруженных
            $(this).parent().parent().remove();
        }
        return false;
    });
}
</script>
<div id="<?=$hash?>-upload_container">
    <div id="<?=$hash?>-uploaded_images" class="sortable grid">
        <?if (is_array($value) AND !empty($value)):?>
            <?foreach ($value as $i=>$val):?>
                <?
                $image_file = CFile::GetPath($val['VALUE']);
                $image_size = CFile::GetImageSize($_SERVER['DOCUMENT_ROOT'].$image_file);
                $image_filesize = filesize($_SERVER['DOCUMENT_ROOT'].$image_file);
                if ($image_filesize<1024) $image_filesize .= " ".GetMessage("SHOPOLIA_IMAGES_B");
                elseif ($image_filesize<1024*1024) $image_filesize = round($image_filesize/1024)." ".GetMessage("SHOPOLIA_IMAGES_KB");
                elseif ($image_filesize<1024*1024*1024) $image_filesize = (round($image_filesize*100/1024/1024)/100)." ".GetMessage("SHOPOLIA_IMAGES_MB");
                $image_thumb = $_SERVER['DOCUMENT_ROOT'].str_replace(".", "_thumb.", $image_file);
                $image_thumb_url = str_replace(".", "_thumb.", $image_file);
                CFile::ResizeImageFile($_SERVER['DOCUMENT_ROOT'].$image_file, $image_thumb, array('width'=>$thumb_width, 'height'=>$thumb_height), BX_RESIZE_IMAGE_PROPORTIONAL);
                ?>
                <input type="hidden" name="<?=str_replace(array("PROP", '[VALUE]'), array("PROP_del", ""), $prop_name)?>[<?=$i?>]" value="Y" id="<?=$hash?>-del_image_<?=$val['VALUE']?>" disabled="disabled">
                <label for="select_<?=$index?>" draggable="true" onclick="ImgShw('<?=CFile::GetPath($val['VALUE'])?>','<?=$image_size[0]?>','<?=$image_size[1]?>', ''); return false;" id="prop_<?=md5($prop_name.$val['VALUE'])?>">
                    <input type="hidden" name="<?=$prop_name?>[<?=$i?>]" value="<?=$val['VALUE']?>" id="<?=$hash?>-hidden_image_<?=$val['VALUE']?>" disabled="disabled">
                    <div class="photo_manage">
                        <a href="#" class="delete_photo" rel="<?=$val['VALUE']?>">X</a>
                    </div>
                    <img src="<?=$image_thumb_url?>" alt=""  id="image_<?=$val['VALUE']?>" />
                </label>
                <script type="text/javascript">
                    new top.BX.CHint({
                        parent: top.BX("prop_<?=md5($prop_name.$val['VALUE'])?>"),
                        show_timeout: 10,
                        hide_timeout: 200,
                        dx: 2,
                        preventHide: true,
                        min_width: 250,
                        hint: '<span class=\"adm-input-file-hint-row\"><?=GetMessage("SHOPOLIA_IMAGES_VOLUME")?>:&nbsp;&nbsp;<?=$image_filesize?></span><span class=\"adm-input-file-hint-row\"><?=GetMessage("SHOPOLIA_IMAGES_SIZE")?>:&nbsp;&nbsp;<?=$image_size[0]?>x<?=$image_size[1]?></span><span class=\"adm-input-file-hint-row\"><?=GetMessage("SHOPOLIA_IMAGES_LINK")?>:&nbsp;&nbsp;<a href=\"<?=$image_file?>\"><?=$image_file?></a></span>'
                    });
                </script>
            <?endforeach;?>
            <input type="hidden" name="shopolia_images_resort" value="<?=$arProperty['ID']?>" id="<?=$hash?>-shopolia_images_resort" disabled="disabled">
            <br>
        <?else:?>
            <span><?=GetMessage("SHOPOLIA_IMAGES_MOVE_FILE_HERE")?></span>
        <?endif;?>
    </div>
    <input name="" value="<?=GetMessage("SHOPOLIA_IMAGES_SELECT_FILES")?>" title="<?=GetMessage("SHOPOLIA_IMAGES_SELECT_FILES")?>" type="button" id="<?=$hash?>-pickfiles">
    <span id="<?=$hash?>-upload_images_status"><?=GetMessage("SHOPOLIA_IMAGES_UPLOADING_NOT_STARTED")?></span>
    <?if ($upload_width OR $upload_height):?>
        <div class="shopolia_images_small_warning">
        <?=GetMessage("SHOPOLIA_IMAGES_WILL_BE_RESIZED")?>
        <?=$upload_width?str_replace("#upload_width#", $upload_width, GetMessage("SHOPOLIA_IMAGES_UPLOAD_WIDTH")):""?> 
        <?=$upload_width&&$upload_height?GetMessage("SHOPOLIA_IMAGES_AND"):""?>
        <?=$upload_height?str_replace("#upload_height#", $upload_height, GetMessage("SHOPOLIA_IMAGES_UPLOAD_HEIGHT")):""?>
        <?=GetMessage("SHOPOLIA_IMAGES_SAVE_PROPORTIONS")?>
        <?=$upload_quality?str_replace("#upload_quality#", $upload_quality, GetMessage("SHOPOLIA_IMAGES_UPLOAD_QUALITY")):""?>
        .
        </div>
    <?endif;?>
</div>

<?
        if ($strHTMLControlName['MODE']!="FORM_FILL") { // only on edit form
            $html = ob_get_clean();
            return $html;
        }
    }
    
    function CheckFields ($arProperty, $value){
        $arResult = array();
        return $arResult;
    }
    
    function ConvertToDB ($arProperty, $value) { // once
        global $USER;
        $arResult = array();
        $uploaddir = COption::GetOptionString("shopolia.images", "upload_dir", "/upload/ajax_uploads/").$USER->GetID()."/";
        if (self::$counter>=0) {
            $array_part = array_slice($_POST['PROP'][$arProperty['ID']], self::$counter, 1, true);
            if (is_array($array_part)) {
                foreach ($array_part as $key=>$newFile) {
                    if (is_numeric($newFile['VALUE'])) {
                        if ($_POST['PROP_del'][$arProperty['ID']][$key]=="Y") {
                            $arResult['VALUE']['del'] = "Y";
                        }
                    } else {
                        $arResult['VALUE'] = CFile::MakeFileArray($uploaddir.$newFile['VALUE']);
                        $arResult['DESCRIPTION'] = $newFile['DESCRIPTION'];
                    }
                }
            }
        }
        self::$counter++;
        //d($arResult); exit();
        return $arResult;
    }
    
    function ConvertFromDB($arProperty, $value) {
        return $value;
    }
}

?>
