<?php

namespace userAgent\userAgent\Detector\OS;


class RedHat extends AbstractOSDetector
{
    protected static $link = 'http://www.redhat.com/';
    protected static $name = 'Red Hat';
    protected static $regEx = '/Red(\ )?Hat/i';
    protected static $regExVersion = '/Red(\ )Hat\/[.\-0-9]+\.el([_.0-9a-zA-Z]+)/i';


    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return str_replace('_', '.', $regmatch[2]);
        }

        return 'unknown';
    }
}