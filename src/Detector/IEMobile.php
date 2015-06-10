<?php

namespace userAgent\userAgent\Detector;


class IEMobile extends BaseDetector {
    protected static $link = 'http://www.microsoft.com/windowsmobile/en-us/downloads/microsoft/internet-explorer-mobile.mspx';
    protected static $name = 'IEMobile';
    protected static $regEx = 'IEMobile';
    protected static $isMobile = true;
}