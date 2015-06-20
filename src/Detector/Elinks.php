<?php

namespace userAgent\userAgent\Detector;


class Elinks extends AbstractBrowserDetector
{
    protected static $link = 'http://elinks.or.cz/';
    protected static $name = 'ELinks';
    protected static $regEx = '/ELinks/i';
    protected static $regExVersion = '/Elinks[\/|\ ]?[\ \(]?([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            return $regmatch[1];
        }

        return 'unknown';
    }

}