<?php

namespace userAgent\userAgent\Detector;


class GoogleChrome extends AbstractBrowserDetector
{
    protected static $link = 'http://google.com/chrome/';
    protected static $name = 'Google Chrome';
    protected static $regEx = '/Chrome/i';
    protected static $excludedRegEx = '/114Browser|115Browser|360se|YaBrowser|MRCHROME|Flock|Vivaldi/i';

}