<?php

namespace userAgent\userAgent\Detector;


class YandexBrowser extends AbstractBrowserDetector
{
    protected static $link = 'http://browser.yandex.com/';
    protected static $name = 'Yandex Browser';
    protected static $regEx = '/YaBrowser/i';
}