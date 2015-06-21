<?php

namespace userAgent\userAgent\Detector\OS;


class Slackware extends AbstractOSDetector
{
    protected static $link = 'http://www.slackware.com/';
    protected static $name = 'Slackware';
    protected static $regEx = '/Slackware/i';
    protected static $regExVersion = '/Slackware[\/|\ ]([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}