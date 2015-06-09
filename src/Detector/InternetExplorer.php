<?php

namespace userAgent\userAgent\Detector;


use userAgent\userAgent\UserAgent;

class InternetExplorer extends BaseDetector
{
    protected static $link = 'http://www.microsoft.com/windows/products/winfamily/ie/default.mspx';
    protected static $name = 'Internet Explorer';
    protected static $regEx = '/MSIE|Trident/i';

    public static function detect(UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();
        if (preg_match(static::$regEx, $userAgentString, $result)) {
            return [
                'name' => static::$name,
                'version' => static::detectVersion($userAgentString),
                'is_mobile' => static::$isMobile
            ];
        }

        return false;
    }

    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'unknown';


        // TODO: Detect compatible mode (when rv and msie)
        if (preg_match('/\ rv:([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
            || preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
        ) {
            $version = $regmatch[1];
        }

        return $version;
    }
}