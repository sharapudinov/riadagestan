<?php

use \Bitrix\Main\Application;

$sSidebarPath = $APPLICATION->GetProperty('sidebar-path');
if (strlen($sSidebarPath) > 0 && file_exists(Application::getDocumentRoot().$sSidebarPath)):
?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "AREA_FILE_SHOW" => "file",
            "PATH" => $sSidebarPath,
            "EDIT_TEMPLATE" => ""
        ),
        false
    );?>
<?php else: ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "AREA_FILE_SHOW" => "sect",
            "AREA_FILE_SUFFIX" => "sidebar",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => ""
        ),
        false
    );?>
<?php endif; ?>
