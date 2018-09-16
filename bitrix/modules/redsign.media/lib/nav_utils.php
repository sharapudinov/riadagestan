<?php

namespace Redsign\Media;

use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Uri;

class NavUtils {
    protected static $uri;
    protected static $delParams;

    protected static function getCurrentUri() {
        $request = Application::getInstance()->getContext()->getRequest();

        $uriString = $request->getRequestUri();
        $uri = new Uri($uriString);

        
    }

    public static function getNextPageLink($navNum, $currenPage) {
        if (!self::$uri) {
            self::getCurrentUri();
        }
    }

    public static function getPrevPageLink($navNum, $currentPage) {
        if (!self::$uri) {
            self::getCurrentUri();
        }
    }
}
