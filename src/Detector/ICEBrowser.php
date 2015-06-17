<?php

namespace userAgent\userAgent\Detector;

class ICEBrowser extends AbstractBrowserDetector
{
    protected static $link = 'http://www.icesoft.com/products/icebrowser.html';
    protected static $name = 'ICEBrowser';
    protected static $regEx = '/Ice[\ ]?Browser/i';

    public static function detectVersion($userAgentString)
    {
        return str_replace('v', '', parent::detectVersion($userAgentString));
    }
}