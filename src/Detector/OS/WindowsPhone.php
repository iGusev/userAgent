<?php

namespace userAgent\userAgent\Detector\OS;

use userAgent\userAgent\Detector\BaseDetector;
use userAgent\userAgent\UserAgent;

class WindowsPhone extends BaseDetector
{
    protected static $link = 'http://www.windowsphone.com/';
    protected static $name = 'Windows Phone';
    protected static $regEx = '/Windows Phone|WPDesktop|ZuneWP7|WP7/i';
    protected static $isMobile = true;

    public static function detect(UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();
        if (preg_match(static::$regEx, $userAgentString)) {
            $userAgent->setOs(static::$name);
            $userAgent->setOsVersion(self::detectVersion($userAgentString));
            $userAgent->setIsMobile(static::$isMobile);

            return true;
        }

        return false;
    }

    public static function detectVersion($userAgentString)
    {
        $version = 'unknown';

        if (preg_match('/Windows Phone (OS )?([0-9\.]+)/i', $userAgentString, $regmatch)) {
            $version = $regmatch[2];
        }

        return $version;
    }
}