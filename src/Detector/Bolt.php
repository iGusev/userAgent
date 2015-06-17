<?php

namespace userAgent\userAgent\Detector;


class Bolt extends AbstractBrowserDetector
{
    protected static $link = 'http://www.boltbrowser.com/';
    protected static $name = 'Bolt';
    protected static $regEx = '/Bolt/i';

}