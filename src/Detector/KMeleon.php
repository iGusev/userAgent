<?php

namespace userAgent\userAgent\Detector;


class KMeleon extends AbstractBrowserDetector
{
    protected static $link = 'http://kmeleon.sourceforge.net/';
    protected static $name = 'K-Meleon';
    protected static $regEx = '/K-Meleon/i';

}