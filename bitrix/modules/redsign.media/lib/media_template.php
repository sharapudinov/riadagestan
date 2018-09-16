<?php

namespace Redsign\Media;

use \Bitrix\Main\Localization\loc;

Loc::loadMessages(__FILE__);

class MediaTemplate {
    
    public static function getAllSocials() {
        return [
            'collections' => Loc::getMessage('RS_SOCIALS_COLLECTIONS'),
            'vkontakte' => Loc::getMessage('RS_SOCIALS_VK'),
            'facebook' => Loc::getMessage('RS_SOCIALS_FACEBOOK'),
            'odnoklassniki' => Loc::getMessage('RS_SOCIALS_OK'),
            'moimir' => Loc::getMessage('RS_SOCIALS_MOIMIR'),
            'gplus' => Loc::getMessage('RS_SOCIALS_GPLUS'),
            'twitter' => Loc::getMessage('RS_SOCIALS_TWITTER'),
            'blogger' => Loc::getMessage('RS_SOCIALS_BLOGGER'),
            'delicious' => Loc::getMessage('RS_SOCIALS_DELICIOUS'),
            'digg' => Loc::getMessage('RS_SOCIALS_DIGG'),
            'reddit' => Loc::getMessage('RS_SOCIALS_REDDIT'),
            'evernote' => Loc::getMessage('RS_SOCIALS_EVERNOTE'),
            'linkedin' => Loc::getMessage('RS_SOCIALS_LINKEDING'),
            'lj' => Loc::getMessage('RS_SOCIALS_LJ'),
            'pocket' => Loc::getMessage('RS_SOCIALS_POCKET'),
            'qzone' => Loc::getMessage('RS_SOCIALS_QZONE'),
            'renren' => Loc::getMessage('RS_SOCIALS_RENREN'),
            'sinaWeibo' => Loc::getMessage('RS_SOCIALS_SW'),
            'surfingbird' => Loc::getMessage('RS_SOCIALS_SURFINGBIRD'),
            'tencentWeibo' => Loc::getMessage('RS_SOCIALS_TW'),
            'tumblr' => Loc::getMessage('RS_SOCIALS_TUMBLR'),
            'viber' => Loc::getMessage('RS_SOCIALS_VIBER'),
            'whatsapp' => Loc::getMessage('RS_SOCIALS_WHATSAPP'),
            'skype' => Loc::getMessage('RS_SOCIALS_SKYPE'),
            'telegram' => Loc::getMessage('RS_SOCIALS_TELEGRAM'),
        ];
    }

    
    public static function showShareLinks(
        $arSocials = array(),
        $arModifiers = array('full'),
        $arParams = array(),
        $sLangId = '',
        $sShareClass = 'b-share-socials'
    ) {
        if (!is_array($arSocials) || count($arSocials) == 0) {
            return;
        }
        
        if (empty($sLangId)) {
            $sLangId = LANGUAGE_ID;
        }
        
        $sBlockId = 'ya-share-'.(\Bitrix\Main\Security\Random::getString(10, true));
        
        $sClasses = $sShareClass;
        if (is_array($arModifiers) && count($arModifiers) > 0) {
            foreach ($arModifiers as $sModifier) {
                $sClasses .= ' '.$sShareClass.'--'.$sModifier;
            }
        }
        
        $sSocials = implode(',', $arSocials);
        ?><div class="<?=$sClasses?>"><?php
            ?><div id="<?=$sBlockId?>"  data-services="<?=$sSocials?>" data-lang="<?=$sLangId?>"></div><?php
        ?></div><?php
        ?><script><?php
            ?>var share = Ya.share2('<?=$sBlockId?>', { <?php
                ?>content: <?=\CUtil::PhpToJSObject($arParams); ?><?php
            ?>});<?php
        ?></script><?php
    }
    
    public static function rsTuningOnBeforeGetReadyMacros(\Bitrix\Main\Event $event) {

        if (!\Bitrix\Main\Loader::includeModule('redsign.devfunc'))
            return;

        $arParams = $event->getParameters();
        $macrosManager = $arParams['ENTITY'];

        $macrosList = $macrosManager->getList();
        
        $color11 = $macrosList['COLOR_1_1'];
        if (strlen($color11) == 6) {
            $rsColor11 = new \RSColor($color11);
            $macrosManager->set('COLOR_1_1_DARKEN_7_PERSENT', $rsColor11->darken(7)->getHex());
            $macrosManager->set('COLOR_1_1_DARKEN_10_PERSENT', $rsColor11->darken(10)->getHex());
            $macrosManager->set('COLOR_1_1_GRADIENT', $rsColor11->adjustHue(-34)->saturate(0.05)->lighten(1.37)->getHex());
        } else {
            $macrosManager->set('COLOR_1_1_DARKEN_10_PERSENT', $color11);
            $macrosManager->set('COLOR_1_1_DARKEN_10_PERSENT', $color11);
        }
    }
}