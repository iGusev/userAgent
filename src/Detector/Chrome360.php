<?php

namespace userAgent\userAgent\Detector;


class Chrome360 extends AbstractBrowserDetector
{
    protected static $link = 'http://chrome.360.cn/';
    protected static $name = '360 Chrome';
    protected static $regEx = '/360ee/i';
}