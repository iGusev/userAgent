<?php

namespace userAgent\userAgent\Detector\OS;


class NetBSD extends AbstractOSDetector
{
    protected static $link = 'http://www.netbsd.org/';
    protected static $name = 'NetBSD';
    protected static $regEx = '/NetBSD/i';
}