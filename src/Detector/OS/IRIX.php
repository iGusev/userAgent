<?php

namespace userAgent\userAgent\Detector\OS;


class IRIX extends AbstractOSDetector
{
    protected static $link = 'http://www.sgi.com/partners/?/technology/irix/';
    protected static $name = 'IRIX';
    protected static $regEx = '/IRIX/i';
    protected static $regExVersion = '/IRIX(64)?\ ([.0-9a-zA-Z]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[2];
        }

        return 'unknown';
    }
}