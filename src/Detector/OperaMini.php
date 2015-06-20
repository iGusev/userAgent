<?php

namespace userAgent\userAgent\Detector;


class OperaMini extends AbstractBrowserDetector
{
    protected static $link = 'http://www.opera.com/mobile/mini';
    protected static $name = 'Opera Mini';
    protected static $regEx = '/Opera Mini|OPiOS/i';
    protected static $regExVersion = '/[Mini|OPiOS][\/]([.0-9]+)/i';
    protected static $isMobile = true;

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}