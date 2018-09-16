<?php

namespace Redsign\Media;

use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Localization\Loc;
use \Redsign\Media\SVGIconsManager;
use \Bitrix\Main\Application;

class TextUtils {
    const MODULE_ID = "redsign.master";
    
    public static function getReadingTime($sText, $nWordsPerMinute = 180) {
        
        Loc::loadMessages(__FILE__);
        $sReadingTime = '';
        $nTotalWordCount = str_word_count(\strip_tags($sText), 0, Loc::getMessage('RS_MEDIA_READING_CYRILLIC'));
        $nReadingTimeMinutes = round($nTotalWordCount / $nWordsPerMinute);
        
        if ($nReadingTimeMinutes > 0) {
            $arMinutesTitles = array(
                Loc::getMessage('RS_MEDIA_READING_MINUTE_TITLE_1'),
                Loc::getMessage('RS_MEDIA_READING_MINUTE_TITLE_2'),
                Loc::getMessage('RS_MEDIA_READING_MINUTE_TITLE_3')
            );
            
            $sReadingTime = StringUtils::declOfNum($nReadingTimeMinutes, $arMinutesTitles);
        } else {
            $sReadingTime = Loc::getMessage('RS_MEDIA_READING_LESS_THAN_MINUTE');
        }
        
        return $sReadingTime;
    }

}

