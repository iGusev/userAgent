<?php

namespace userAgent\userAgent\Detector;

class Firebird extends AbstractBrowserDetector
{
    protected static $link = 'http://seb.mozdev.org/firebird/';
    protected static $name = 'FireBird';
    protected static $regEx = '/Firebird/i';
}
