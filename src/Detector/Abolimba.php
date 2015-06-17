<?php

namespace userAgent\userAgent\Detector;


class Abolimba extends AbstractBrowserDetector
{
    protected static $link = 'http://www.aborange.de/products/freeware/abolimba-multibrowser.php';
    protected static $name = 'Abolimba';
    protected static $regEx = '/Abolimba/i';


    public static function detectVersion($userAgentString)
    {
        return 'unknown';
    }
}