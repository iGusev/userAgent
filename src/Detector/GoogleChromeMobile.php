<?php

namespace userAgent\userAgent\Detector;


class GoogleChromeMobile extends GoogleChrome
{
    protected static $regEx = '/CriOS/i';
    protected static $isMobile = true;
}