<?php

namespace userAgent\userAgent\Detector;


class Opera extends AbstractBrowserDetector
{
    protected static $link = 'http://www.opera.com/';
    protected static $name = 'Opera';
    protected static $regEx = '/Opera/i';
    protected static $excludedRegEx = '/Opera Mini|Opera Mobi/i';

}