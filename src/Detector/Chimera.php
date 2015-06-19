<?php

namespace userAgent\userAgent\Detector;


class Chimera extends AbstractBrowserDetector
{
    protected static $link = 'http://www.chimera.org/';
    protected static $name = 'Chimera';
    protected static $regEx = '/Chimera/i';
}