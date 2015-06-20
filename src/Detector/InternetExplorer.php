<?php

namespace userAgent\userAgent\Detector;


class InternetExplorer extends AbstractBrowserDetector
{
    protected static $link = 'http://www.microsoft.com/windows/products/winfamily/ie/default.mspx';
    protected static $name = 'Internet Explorer';
    protected static $regEx = '/MSIE|Trident/i';
    protected static $excludedRegEx = '/IEMobile|2345Explorer|Abolimba|AOL|America Online/i';


    public static function detectVersion($userAgentString)
    {
        // TODO: Detect compatible mode (when rv and msie)
        if (preg_match('/\ rv:([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
            || preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
        ) {
            return $regmatch[1];
        }

        return 'unknown';
    }
}