<?php

namespace userAgent\userAgent\Detector\OS;


class Ubuntu extends AbstractOSDetector
{
    protected static $link = 'http://www.ubuntu.com/';
    protected static $name = 'Ubuntu';
    protected static $regEx = '/Ubuntu/i';
    protected static $regExVersion = '/Ubuntu[\/|\ ]([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}