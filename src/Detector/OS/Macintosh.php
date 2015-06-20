<?php

namespace userAgent\userAgent\Detector\OS;


class Macintosh extends AbstractOSDetector
{
    protected static $link = 'http://www.apple.com/macosx/';
    protected static $name = 'Macintosh';
    protected static $regEx = '/Mac_PowerPC/i';
}