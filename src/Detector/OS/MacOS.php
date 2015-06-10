<?php

namespace userAgent\userAgent\Detector\OS;

use userAgent\userAgent\UserAgent;

class MacOS extends AbstractOSDetector
{
    protected static $link = 'http://www.apple.com/macosx/';
    protected static $name = 'Mac OS X';
    protected static $regEx = '/Mac|Darwin/i';


    public static function detect(UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();
        if (preg_match(static::$regEx, $userAgentString)) {
            if (preg_match('/Darwin/i', $userAgentString)) {
                static::$name = "Mac OS Darwin";
            } elseif (!preg_match('/(Mac OS ?X)/i', $userAgentString)) {
                static::$name = "Macintosh";
            }

            $userAgent->setOs(static::$name);
            $userAgent->setOsVersion(self::detectVersion($userAgentString));

            return true;
        }


        return false;
    }

    public static function detectVersion($userAgentString)
    {
        $version = 'unknown';

        if (preg_match('/Mac OS [X]? ([._0-9a-zA-Z]+)/i', $userAgentString, $regmatch)) {
            $version = str_replace('_', '.', $regmatch[1]);
        }

        return $version;
    }
}