<?php

namespace userAgent\userAgent\Detector;


class Voyager extends AbstractBrowserDetector
{
    protected static $link = 'http://v3.vapor.com/voyager/';
    protected static $name = 'Voyager';
    protected static $regEx = '/AmigaVoyager/i';
}