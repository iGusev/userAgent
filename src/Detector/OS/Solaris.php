<?php

namespace userAgent\userAgent\Detector\OS;


class Solaris extends AbstractOSDetector
{
    protected static $link = 'http://www.sun.com/software/solaris/';
    protected static $name = 'Solaris';
    protected static $regEx = '/Solaris|SunOS/i';
    protected static $regExVersion = '/(Solaris|SunOS)[\/|\ ]([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}