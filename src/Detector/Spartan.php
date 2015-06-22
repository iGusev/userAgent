<?php

namespace userAgent\userAgent\Detector;


class Spartan extends AbstractBrowserDetector
{
    protected static $link = 'http://windows.microsoft.com/en-us/windows/preview-microsoft-edge-pc/';
    protected static $name = 'Spartan';
    protected static $regEx = '/Windows.+Chrome.+Edge/i';
}