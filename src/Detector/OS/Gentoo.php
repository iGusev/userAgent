<?php

namespace userAgent\userAgent\Detector\OS;


class Gentoo extends AbstractOSDetector
{
    protected static $link = 'http://www.gentoo.org';
    protected static $name = 'Gentoo';
    protected static $regEx = '/Gentoo/i';

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}