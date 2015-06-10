<?php

namespace userAgent\userAgent\Detector;


class Explorer360 extends AbstractBrowserDetector
{
    protected static $link = 'http://se.360.cn/';
    protected static $name = '360 Explorer';
    protected static $regEx = '/360se/i';
}