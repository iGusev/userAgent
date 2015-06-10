<?php

namespace userAgent\userAgent\Detector\OS;

use userAgent\userAgent\Detector\AbstractDetector;
use userAgent\userAgent\UserAgent;

abstract class AbstractOSDetector extends AbstractDetector {
    protected static function setParams(UserAgent $userAgent) {
        $userAgent->setOs(static::$name);
        $userAgent->setOsVersion(static::detectVersion($userAgent->getUserAgentString()));
        $userAgent->setIsMobile(static::$isMobile);
    }
}