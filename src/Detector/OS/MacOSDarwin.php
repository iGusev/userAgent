<?php

namespace userAgent\userAgent\Detector\OS;


class MacOSDarwin extends AbstractOSDetector {
    protected static $link = 'http://www.apple.com/macosx/';
    protected static $name = 'Mac OS Darwin';
    protected static $regEx = '/Darwin/i';

    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}