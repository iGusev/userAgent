<?php

namespace userAgent\userAgent\Detector;


class ChromePlus extends AbstractBrowserDetector
{
    protected static $link = 'http://www.chromeplus.org/';
    protected static $name = 'ChromePlus';
    protected static $regEx = '/ChromePlus/i';
}