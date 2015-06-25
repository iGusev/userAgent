<?php

namespace userAgent\userAgent\Detector;

class OneBrowser extends AbstractBrowserDetector
{
    protected static $link = 'http://one-browser.com/';
    protected static $name = 'OneBrowser';
    protected static $regEx = '/OneBrowser/i';
    protected static $isMobile = true;
}