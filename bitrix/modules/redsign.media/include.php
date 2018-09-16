<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;
use \Redsign\Media;

Loc::loadMessages(__FILE__);

Loader::registerAutoLoadClasses(
    'redsign.media',
    array(
        '\Redsign\Media\SVGIconsManager' => 'lib/svg_icons_manager.php',
        '\Redsign\Media\AdminUtils' => 'lib/admin_utils.php',
        '\Redsign\Media\StringUtils' => 'lib/string_utils.php',
        '\Redsign\Media\TextUtils' => 'lib/text_utils.php',
        '\Redsign\Media\MediaTemplate' => 'lib/media_template.php'
    )
);


global $arMediaFeaturedFilter;
$arMediaFeaturedFilter = array(
    'PROPERTY_IS_FEATURED_VALUE' => 'Y'
);