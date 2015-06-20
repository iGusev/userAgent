<?php

namespace userAgent\userAgent\Detector\OS;


class NetBSD extends AbstractOSDetector
{
    protected static $link = 'http://www.netbsd.org/';
    protected static $name = 'NetBSD';
    protected static $regEx = '/NetBSD/i';
    protected static $regExVersion = '/NetBSD[\/|\ ]([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}