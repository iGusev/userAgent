<?php

namespace userAgent\userAgent\Detector;


class KMLite extends AbstractBrowserDetector
{
    protected static $link = 'http://kmeleon.sourceforge.net/';
    protected static $name = 'K-Meleon Lite';
    protected static $regEx = '/KMLite/i';

}