<?php

namespace userAgent\userAgent\Detector\OS;


class moonOS extends AbstractOSDetector
{
    protected static $link = 'http://www.moonos.org/';
    protected static $name = 'moonOS';
    protected static $regEx = '/moonOS/i';
    protected static $regExVersion = '/moonOS\/([.0-9a-zA-Z]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}