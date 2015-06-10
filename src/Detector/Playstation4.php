<?php

namespace userAgent\userAgent\Detector;


class Playstation4 extends BaseDetector {
    protected static $link = 'http://us.playstation.com/';
    protected static $name = 'PS4 Web Browser';
    protected static $regEx = '/Playstation 4/i';

}