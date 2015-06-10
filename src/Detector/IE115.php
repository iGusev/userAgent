<?php

namespace userAgent\userAgent\Detector;


class IE115 extends BaseDetector
{
    protected static $link = 'http://ie.115.com/';
    protected static $name = '115Browser';
    protected static $regEx = '/115Browser/i';
}