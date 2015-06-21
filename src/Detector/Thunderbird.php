<?php

namespace userAgent\userAgent\Detector;


class Thunderbird extends AbstractBrowserDetector
{
    protected static $link = 'http://www.mozilla.com/thunderbird/';
    protected static $name = 'Thunderbird';
    protected static $regEx = '/Thunderbird/i';
}