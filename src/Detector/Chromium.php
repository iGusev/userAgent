<?php

namespace userAgent\userAgent\Detector;


class Chromium extends AbstractBrowserDetector
{
    protected static $link = 'http://www.chromium.org/';
    protected static $name = 'Chromium';
    protected static $regEx = '/Chromium/i';
}