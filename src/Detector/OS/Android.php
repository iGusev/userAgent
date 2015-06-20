<?php

namespace userAgent\userAgent\Detector\OS;


class Android extends AbstractOSDetector
{
    protected static $link = 'http://www.android.com/';
    protected static $name = 'Android';
    protected static $regEx = '/Android|ADR/i';
    protected static $regExVersion = '/(Android|Adr)[\ |\/]?([.0-9a-zA-Z]+)/i';
    protected static $isMobile = true;

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[2];
        }

        return 'unknown';
    }
}