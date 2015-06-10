<?php

namespace userAgent\userAgent\Detector;

use userAgent\userAgent\UserAgent;

abstract class AbstractBrowserDetector extends AbstractDetector {
    protected static function setParams(UserAgent $userAgent) {
        $userAgent->setBrowser(static::$name);
        $userAgent->setBrowserVersion(static::detectVersion($userAgent->getUserAgentString()));
        $userAgent->setIsMobile(static::$isMobile);
    }
}