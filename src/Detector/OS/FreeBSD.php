<?php

namespace userAgent\userAgent\Detector\OS;


class FreeBSD extends AbstractOSDetector
{
    protected static $link = 'http://www.freebsd.org/';
    protected static $name = 'FreeBSD';
    protected static $regEx = '/FreeBSD/i';
    protected static $regExVersion = '/FreeBSD[\/|\ ]([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}