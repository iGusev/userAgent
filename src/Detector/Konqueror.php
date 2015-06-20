<?php

namespace userAgent\userAgent\Detector;


class Konqueror extends AbstractBrowserDetector
{
    protected static $link = 'http://konqueror.kde.org/';
    protected static $name = 'Konqueror';
    protected static $regEx = '/Konqueror/i';
}