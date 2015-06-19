<?php

namespace userAgent\userAgent\Detector\OS;


class MacOSDarwin extends AbstractOSDetector {
    protected static $link = 'http://www.apple.com/macosx/';
    protected static $name = 'Mac OS Darwin';
    protected static $regEx = '/Darwin/i';

    public static function detectVersion($userAgentString)
    {
        $version = 'unknown';

        if (preg_match('/Mac OS [X]? ([._0-9]+)/i', $userAgentString, $regmatch)) {
            $version = str_replace('_', '.', $regmatch[1]);
        }

        return $version;
    }
}