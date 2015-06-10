<?php

namespace userAgent\userAgent\Detector;


class AphoneBrowser360 extends AbstractBrowserDetector
{
    protected static $link = 'http://mse.360.cn/index.html';
    protected static $name = '360 Aphone Browser';
    protected static $regEx = '/360 aphone browser/i';
    protected static $isMobile = true;
}