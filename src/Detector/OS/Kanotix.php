<?php

namespace userAgent\userAgent\Detector\OS;


class Kanotix extends AbstractOSDetector
{
    protected static $link = 'http://www.kanotix.org/';
    protected static $name = 'Kanotix';
    protected static $regEx = '/Kanotix/i';

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}