<?php

namespace userAgent\userAgent\Detector;

class InternetExplorer extends BaseDetector
{
    protected static $link = 'http://www.microsoft.com/windows/products/winfamily/ie/default.mspx';
    protected static $name = 'Internet Explorer';
    protected static $regEx = 'MSIE|Trident';

    public static function detectVersion($userAgentString)
    {
        // Grab the browser version if its present
        $version = 'unknown';


        // TODO: Detect compatible mode (when rv and msie)
        if (preg_match('/\ rv:([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
            || preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $userAgentString, $regmatch)
        ) {
            $version = $regmatch[1];
        }

        return $version;
    }
}