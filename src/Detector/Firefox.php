<?php

namespace userAgent\userAgent\Detector;


class Firefox extends AbstractBrowserDetector
{
    protected static $link = 'http://www.mozilla.org/';
    protected static $name = 'Firefox';
    protected static $regEx = '/Firefox/i';
    protected static $excludedRegEx = '/Flock|K-Meleon/i';

}