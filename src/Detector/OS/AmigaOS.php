<?php

namespace userAgent\userAgent\Detector\OS;


class AmigaOS extends AbstractOSDetector
{
    protected static $link = 'http://www.amigaos.net/';
    protected static $name = 'AmigaOS';
    protected static $regEx = '/AmigaOS/i';

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}