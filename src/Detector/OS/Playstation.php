<?php

namespace userAgent\userAgent\Detector\OS;

use userAgent\userAgent\Detector\BaseDetector;
use userAgent\userAgent\UserAgent;

class Playstation extends BaseDetector
{
    protected static $link = 'http://us.playstation.com/';
    protected static $name = 'Playstation';
    protected static $regEx = '/Playstation/i';

    public static function detect(UserAgent $userAgent)
    {
        $userAgentString = $userAgent->getUserAgentString();
        if (preg_match(static::$regEx, $userAgentString)) {
            $userAgent->setOs(static::$name);
            $userAgent->setOsVersion(static::detectVersion($userAgentString));
            $userAgent->setIsMobile(static::$isMobile);

            return true;
        }

        return false;
    }
}