<?php

namespace userAgent\userAgent\Detector\OS;


class openSUSE extends AbstractOSDetector
{
    protected static $link = 'http://www.opensuse.org/';
    protected static $name = 'openSUSE';
    protected static $regEx = '/suse/i';
}