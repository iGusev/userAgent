<?php

namespace userAgent\userAgent\Detector\OS;


class Playstation extends AbstractOSDetector
{
    protected static $link = 'http://us.playstation.com/';
    protected static $name = 'Playstation';
    protected static $regEx = '/Playstation/i';

}