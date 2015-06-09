<?php

namespace userAgent\userAgent\Detector;


class AphoneBrowser360 extends BaseDetector
{
    protected static $link = 'http://mse.360.cn/index.html';
    protected static $browserName = '360 Aphone Browser';
    protected static $browserRegEx = '360 aphone browser';
    protected static $isMobile = true;
}