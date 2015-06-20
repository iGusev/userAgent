<?php

namespace userAgent\userAgent\Detector\OS;


class Kubuntu extends AbstractOSDetector
{
    protected static $link = 'http://www.kubuntu.org/';
    protected static $name = 'Kubuntu';
    protected static $regEx = '/Kubuntu/i';
    protected static $regExVersion = '/Kubuntu[\/|\ ]([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {

        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}