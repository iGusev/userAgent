<?php

namespace userAgent\userAgent\Detector;


class IEMobile extends AbstractBrowserDetector
{
    protected static $link = 'http://www.microsoft.com/windowsmobile/en-us/downloads/microsoft/internet-explorer-mobile.mspx';
    protected static $name = 'IEMobile';
    protected static $regEx = '/IEMobile/i';
    protected static $isMobile = true;
}