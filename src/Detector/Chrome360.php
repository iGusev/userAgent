<?php

namespace userAgent\userAgent\Detector;


class Chrome360 extends BaseDetector
{
    protected static $link = 'http://chrome.360.cn/';
    protected static $browserName = '360 Chrome';
    protected static $browserRegEx = '360ee';
}