<?php

namespace userAgent\userAgent\Detector;


class Vivaldi extends AbstractBrowserDetector
{
    protected static $link = 'http://www.vivaldi.com/';
    protected static $name = 'Vivaldi';
    protected static $regEx = '/Vivaldi/i';

}