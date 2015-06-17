<?php

namespace userAgent\userAgent\Detector;


class Flock extends AbstractBrowserDetector
{
    protected static $link = 'http://www.flock.com/';
    protected static $name = 'Flock';
    protected static $regEx = '/Flock/i';

}