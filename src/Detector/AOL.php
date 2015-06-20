<?php

namespace userAgent\userAgent\Detector;


class AOL extends AbstractBrowserDetector
{
    protected static $link = 'http://downloads.channel.aol.com/browser';
    protected static $name = 'AOL';
    protected static $regEx = '/AOL|America Online[\ Browser]?/i';
    protected static $regExVersion = '/(America Online Browser|AOL(?:-IWENG)*)\ ([.0-9]+)/i';

    public static function detectVersion($userAgentString)
    {
        if (preg_match(static::$regExVersion, $userAgentString, $regmatch)) {
            var_dump($regmatch);
            return $regmatch[2];
        }

        return 'unknown';
    }

}