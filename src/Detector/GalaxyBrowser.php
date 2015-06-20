<?php

namespace userAgent\userAgent\Detector;


class GalaxyBrowser extends AbstractBrowserDetector
{
    protected static $link = 'http://www.traos.org';
    protected static $name = 'Galaxy';
    protected static $regEx = '/Galaxy/i';
    protected static $excludedRegEx = '/Chrome/i';

}