<?php

namespace userAgent\userAgent\Detector\OS;


class J2ME extends AbstractOSDetector
{
    protected static $link = 'http://java.sun.com/javame/';
    protected static $name = 'J2ME';
    protected static $regEx = '/J2ME\/MIDP/i';
    protected static $isMobile = true;

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}