<?php

namespace userAgent\userAgent\Detector\OS;


class SymbianOS extends AbstractOSDetector
{
    protected static $link = 'http://www.kanotix.org/';
    protected static $name = 'SymbianOS';
    protected static $regEx = '/(Symb(ian)?(OS)?|Series 60)/i';
    protected static $regExVersion = '/(?!\/).Symb(ian)?(OS)?\/([.0-9a-zA-Z]+)/i';
    protected static $isMobile = true;


    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[3];
        }

        return 'unknown';
    }
}