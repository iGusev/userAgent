<?php

namespace userAgent\userAgent\Detector\OS;


class iOS extends AbstractOSDetector
{
    protected static $link = 'http://www.apple.com/macosx/';
    protected static $name = 'iOS';
    protected static $regEx = '/iPhone|iPad/i';
    protected static $isMobile = true;

    public static function detectVersion($userAgentString)
    {
        $version = 'unknown';

        if (preg_match('/CPU\ (iPhone\ )?OS\ ([._0-9]+)/i', $userAgentString, $regmatch)) {
            $version = str_replace('_', '.', $regmatch[2]);
        }

        return $version;
    }
}