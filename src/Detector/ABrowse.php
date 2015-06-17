<?php

namespace userAgent\userAgent\Detector;


class ABrowse extends AbstractBrowserDetector
{
    protected static $link = 'http://abrowse.sourceforge.net/';
    protected static $name = 'ABrowse';
    protected static $regEx = '/ABrowse/i';

}