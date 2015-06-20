<?php

namespace userAgent\userAgent\Detector;


class Opera extends AbstractBrowserDetector
{
    protected static $link = 'http://www.opera.com/';
    protected static $name = 'Opera';
    protected static $regEx = '/Opera/i';
    protected static $excludedRegEx = '/Opera Mini|Opera Mobi/i';


    public static function detectVersion($userAgentString)
    {
        if (preg_match('/Version(\/)([.0-9]+)/i', $userAgentString, $regmatch)
            || preg_match('/Opera(\ |\/)([.0-9]+)/i', $userAgentString, $regmatch)
        ) {
            return $regmatch[2];
        }

        return 'unknown';
    }
}