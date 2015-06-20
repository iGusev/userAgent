<?php

namespace userAgent\userAgent\Detector\OS;


class OpenBSD extends AbstractOSDetector
{
    protected static $link = 'http://www.openbsd.org';
    protected static $name = 'OpenBSD';
    protected static $regEx = '/OpenBSD/i';

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}